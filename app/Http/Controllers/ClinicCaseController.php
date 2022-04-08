<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\ClinicCaseTransformer;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ClinicCase;
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
        $clinic_cases = ClinicCase::where('name','LIKE','%'.$request->search.'%')
        ->where('status', true)
        ->with('user')
        ->orderBy($request->orderBy, $request->direction)            
        ->paginate((int)$request->pageSize);

        return response()->json(compact(['clinic_cases']),200);
    }

     /**
     * Display a listing of the resource acording id.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUserCases(Request $request)
    {
        $clinic_cases = ClinicCase::where('name','LIKE','%'.$request->search.'%')
        ->where('user_id', $request->user_id)
        ->orderBy($request->orderBy, $request->direction)            
        ->paginate((int)$request->pageSize);

        return $this->collection($clinic_cases, new ClinicCaseTransformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clinic_case = ClinicCase::find($id);

        if (!$clinic_case) {
            return response()->json(['Caso clinico inexistente'], 400);
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
        $clinic_case->name = $request->name;
        $clinic_case->save();

        return $this->item($clinic_case, new ClinicCaseTransformer);
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
        $clinic_case->name = $request->name;
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
}
