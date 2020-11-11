<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\JelpiTransformer;
use App\Http\Controllers\Controller;
use App\Models\CRMJelpi;
use App\Models\Jelpi;
use Artisan;


class JelpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jelpis = Jelpi::all();

        return $this->response->collection($jelpis, new JelpiTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ciExists = Jelpi::where('ci', $request->ci)->get();

        if (count($ciExists) > 0) {
            return response()->json('ci ya registrado', 400);
        } else {
            $jelpi = new Jelpi();

            $jelpi->firstname = $request->firstname;
            $jelpi->lastname = $request->lastname;
            $jelpi->email = $request->email;
            $jelpi->ci = $request->ci;
            $jelpi->save();

            return $this->response->item($jelpi, new JelpiTransformer);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jelpi = Jelpi::findOrFail($id);

        return $this->response->item($jelpi, new JelpiTransformer);
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
        $jelpi = Jelpi::findOrFail($id);

        $ciExists = Jelpi::where('ci', $request->ci)->get();

        if (count($ciExists) > 0) {
            return response()->json('ci ya registrado', 400);
        }else{
            $jelpi->firstname = $request->firstname;
            $jelpi->lastname = $request->lastname;
            $jelpi->email = $request->email;
            $jelpi->ci = $request->ci;
            $jelpi->save();

            return $this->response->item($jelpi, new JelpiTransformer);
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
        $jelpi = Jelpi::findOrFail($id);

        $jelpi->delete();
        $text = "jelpi eliminado";

        return response()->json(compact('text'), 200);
    }



    public function updateCRMData()
    {
        if (Artisan::call('crmjelpis:update')) {
            return 'jelpis actualizados del crm';
        } else {
            return 'jelpis actualizados del crm fallò';
        }
    }
}
