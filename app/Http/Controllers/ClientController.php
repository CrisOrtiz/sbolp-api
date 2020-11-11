<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Transformers\ClientTransformer;
use App\Http\Controllers\Controller;
use Artisan;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return $this->response->collection($clients, new ClientTransformer);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nameExists = Client::where('name', $request->name)->get();

        if (count($nameExists) > 0) {
            return response()->json('cliente ya registrado', 400);
        } else {
            $client = new Client();

            $client->name = $request->name;
            $client->address = $request->address;            
            $client->nit_ci = $request->nit_ci;
            $client->phone = $request->phone;
            $client->email = $request->email;
            $client->save();

            return $this->response->item($client, new ClientTransformer);
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
        $client = Client::findOrFail($id);

        return $this->response->item($client, new ClientTransformer);
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
        $client = Client::findOrFail($id);

        $client->name = $request->name;
        $client->address = $request->address;            
        $client->nit_ci = $request->nit_ci;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->save();

        return $this->response->item($client, new ClientTransformer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        $client->delete();
        $text = "cliente eliminado";

        return response()->json(compact('text'), 200);
    }
}
