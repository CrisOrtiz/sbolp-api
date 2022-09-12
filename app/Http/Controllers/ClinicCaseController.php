<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\ClinicCaseTransformer;
use App\Http\Controllers\Controller;
use App\Models\ClinicCase;
use App\Models\Item;
use Artisan;


class ClinicCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clinic_cases = ClinicCase::where('status', true)
            ->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', "%{$request->search}%")
                    ->orWhere('description', 'LIKE', "%{$request->search}%");
            })
            ->with('user')
            ->with('comments')
            ->with('images')
            ->orderBy($request->orderBy, $request->direction)
            ->paginate((int)$request->pageSize);

        return response()->json(compact(['clinic_cases']), 200);
    }

    /**
     * Display a listing of the resource according id.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUserCases(Request $request)
    {
        $clinic_cases = ClinicCase::where('user_id', $request->user_id)
            ->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', "%{$request->search}%")
                    ->orWhere('description', 'LIKE', "%{$request->search}%");
            })
            ->with('user')
            ->with('comments')
            ->with('images')
            ->orderBy($request->orderBy, $request->direction)
            ->paginate((int)$request->pageSize);

        return response()->json(compact(['clinic_cases']), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clinic_case = ClinicCase::where('id', $id)->with('user')->with('comments')->with('images')->get();

        if (!$clinic_case) {
            return response()->json(['Caso inexistente'], 400);
        }

        return $this->item($clinic_case, new ClinicCaseTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clinic_case = new ClinicCase();
        $clinic_case->user_id = $request->user_id;
        $clinic_case->title = $request->title;
        $clinic_case->description = $request->description;
        $clinic_case->diagnostic = $request->diagnostic;
        $clinic_case->treatment_phase_one = $request->treatment_phase_one;
        $clinic_case->procedure_phase_one = $request->procedure_phase_one;
        $clinic_case->hasSecondPhase = $request->hasSecondPhase;
        $clinic_case->treatment_phase_two = $request->treatment_phase_two;
        $clinic_case->procedure_phase_two = $request->procedure_phase_two;
        $clinic_case->conclusions = $request->conclusions;
        $clinic_case->advices = $request->advices;
        $clinic_case->status = $request->status;
        $clinic_case->save();

        return response()->json(compact(['clinic_case']), 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clinic_case = ClinicCase::findOrFail($id);
        $clinic_case->title = $request->title;
        $clinic_case->description = $request->description;
        $clinic_case->diagnostic = $request->diagnostic;
        $clinic_case->treatment_phase_one = $request->treatment_phase_one;
        $clinic_case->procedure_phase_one = $request->procedure_phase_one;
        $clinic_case->treatment_phase_two = $request->treatment_phase_two;
        $clinic_case->procedure_phase_two = $request->procedure_phase_two;
        $clinic_case->conclusions = $request->conclusions;
        $clinic_case->advices = $request->advices;
        $clinic_case->save();

        return $this->item($clinic_case, new ClinicCaseTransformer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clinic_case = ClinicCase::findOrFail($id);
        $clinic_case->delete();
        $text = "caso clinico eliminado";

        return response()->json(compact('text'), 200);
    }

    public function changeStatus(Request $request)
    {
        $status = 'update clinic case status failed';

        $clinic_case = ClinicCase::where('id', $request->id)->first();
        if ($request->status == false) {
            $clinic_case->status = true;
        } elseif ($request->status == true) {
            $clinic_case->status = false;
        }
        $clinic_case->save();

        if ($clinic_case->save()) {
            $status = 'Success';
            return response()->json(compact(['clinic_case', 'status']), 200);
        } else {
            $message = 'Clinic case update status failed';
            return response()->json(compact('status', 'message'), 401);
        }
    }
}
