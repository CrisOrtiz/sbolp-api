<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\ItemTransformer;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Artisan;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        return $this->response->collection($items, new ItemTransformer);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByAgency(Request $request)
    {
        if($request->agency == ""){
            $items = Item::all();
            return $this->response->collection($items, new ItemTransformer);
        }elseif($request->agency == "1"){
            $items = Item::where('agency', $request->agency)->get();
            return $this->response->collection($items, new ItemTransformer);
        }elseif($request->agency == "2"){
            $items = Item::where('agency', $request->agency)->get();
            return $this->response->collection($items, new ItemTransformer);
        }else{
            return response()->json(['Error al devolver items en agencia'], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemRegistered = Item::where('product_id', $request->product_id)->first();

        if(!$itemRegistered){
            $item = new Item();
            $item->product_id = $request->product_id;
            $item->description = $request->description;
            $item->qty = $request->qty;
            $item->agency = $request->agency;
            $item->total = $request->total;
            $item->save();
            return $this->response->item($item, new ItemTransformer);
        }else{
            return response()->json(['Item ya en inventario'], 400);
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
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['Item inexistente'], 400);
        }

        return $this->response->item($item, new ItemTransformer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $item = Item::findOrFail($id);

        if($item->product_id == $request->product_id){
            $item->product_id = $request->product_id;
            $item->description = $request->description;
            $item->qty = $request->qty;
            $item->agency = $request->agency;
            $item->total = $request->total;
            $item->save();
            return $this->response->item($item, new ItemTransformer);
        }else{            
            return response()->json(['Item ya en inventario'], 400); 
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
        $item = Item::findOrFail($id);

        $item->delete();
        $text = "item eliminado";

        return response()->json(compact('text'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request)
    {
        $itemRegistered = Item::where('product_id', $request->product_id)->first();

        if(!$itemRegistered){
            $item = new Item();
            $item->product_id = $request->product_id;
            $item->description = $request->description;
            $item->qty = $request->qty;
            $item->agency = $request->agency;
            $item->total = $request->total;
            $item->save();
            return $this->response->item($item, new ItemTransformer);
        }else{
            return response()->json(['Item ya en inventario'], 400);
        }   
    }
}
