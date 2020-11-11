<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serializers\NoDataArraySerializer;
use App\Transformers\SaleTransformer;
use App\Models\Sale;
use App\Models\Item;
use App\Models\SaleArticle;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::with('items')->get();
        $resource = 'sales';

        return $this->collection($sales, new SaleTransformer, function ($resource, $fractal) {
            $fractal->setSerializer(new NoDataArraySerializer());
        });
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
        $sale = new Sale();
       
        $sale->client_id =  $request->client_id;
        $sale->user_id = $request->user_id;
        $sale->date = $request->date;
        $sale->save();

        for ($i=0; $i < count($request->items) ; $i++) { 
            $sale_item= new SaleItem();

            $sale_item->sale_id = $sale->id;
            $sale_item->product_id = $request->items[$i]['product_id'];
            $sale_item->qty = $request->items[$i]['qty'];
            $sale_item->price = $request->items[$i]['price'];
            $sale_item->save();

            
            $item = Item::where('product_id', $request->items[$i]['product_id'])->first();

            if(!$item){
                $item = new Item();
                $item->product_id = $request->items[$i]['product_id'];
                $item->qty = $request->items[$i]['qty'];
                $item->save();              
            }else{                
                $item->qty = $item->qty + $request->qty;
                $item->save();   
            }   
        
        }      

        $resource = 'sale';

        return $this->item($sale, new SaleTransformer, function ($resource, $fractal) {
            $fractal->setSerializer(new NoDataArraySerializer());
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::findOrFail($id);

        return $this->item($sale, new SaleTransformer, function ($resource, $fractal) {
            $fractal->setSerializer(new NoDataArraySerializer());
        });
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
