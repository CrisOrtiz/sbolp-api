<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\PatientTransformer;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Patient;
use Artisan;



class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();

        return $this->response->collection($patients, new PatientTransformer);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['Paciente inexistente'], 400);
        }

        return $this->response->item($patient, new PatientTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = new Patient();

        $patientExists = Patient::where('ci', $request->ci)->first();

        if( $patientExists){
            $text = "El ci pertenece a otro paciente";
            return response()->json(compact('text'), 400);
        }else{
            $patient->ci = $request->ci;
            $patient->name = $request->name;
            $patient->last_name = $request->last_name;
            $patient->save();
        }

        return $this->response->item($patient, new PatientTransformer);
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
        $patient = Patient::findOrFail($id);

        if($patient->ci == $request->ci){
            $patient->ci = $request->ci;
            $patient->name = $request->name;
            $patient->last_name = $request->last_name;
            $patient->save();
            return $this->response->item($patient, new PatientTransformer);
        }else{
            $ciExists = Patient::where('ci', $request->ci)->first();
            if($ciExists){
                $text = "El ci pertenece a otro producto";
                return response()->json(compact('text'), 400);
            }else{
                $patient->ci = $request->ci;
                $patient->name = $request->name;
                $patient->last_name = $request->last_name;
                $patient->save();
            }
            return $this->response->item($patient, new PatientTransformer);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        $patient->delete();
        $text = "paciente eliminado";

        return response()->json(compact('text'), 200);
    }
}
