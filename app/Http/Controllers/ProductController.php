<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\ProductTransformer;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Item;
use Artisan;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return $this->response->collection($products, new ProductTransformer);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['Producto inexistente'], 400);
        }

        return $this->response->item($product, new ProductTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $codeExists = Product::where('code', $request->code)->first();

        if( $codeExists){
            $text = "El codigo pertenece a otro producto";
            return response()->json(compact('text'), 400);
        }else{
            $product->code = $request->code;
            $product->description = $request->description;
            $product->buy_price = $request->buy_price;
            $product->sell_price = $request->sell_price;
            $product->wholesale_price = $request->wholesale_price;
            $product->agency_1_stock = $request->agency_1_stock;
            $product->agency_2_stock = $request->agency_2_stock;
            $product->total_stock = $request->total_stock;
            $product->save();
        }

        return $this->response->item($product, new ProductTransformer);
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
        $product = Product::findOrFail($id);

        if($product->code == $request->code){
            $product->description = $request->description;
            $product->buy_price = $request->buy_price;
            $product->sell_price = $request->sell_price;
            $product->wholesale_price = $request->wholesale_price;
            $product->agency_1_stock = $request->agency_1_stock;
            $product->agency_2_stock = $request->agency_2_stock;
            $product->total_stock = $request->total_stock;
            $product->image_url = $request->image_url;
            $product->save();
            return $this->response->item($product, new ProductTransformer);
        }else{
            $codeExists = Product::where('code', $request->code)->first();
            if($codeExists){
                $text = "El codigo pertenece a otro producto";
                return response()->json(compact('text'), 400);
            }else{
                $product->code = $request->code;
                $product->description = $request->description;
                $product->buy_price = $request->buy_price;
                $product->sell_price = $request->sell_price;
                $product->wholesale_price = $request->wholesale_price;
                $product->agency_1_stock = $request->agency_1_stock;
                $product->agency_2_stock = $request->agency_2_stock;
                $product->total_stock = $request->total_stock;
                $product->image_url = $request->image_url;
                $product->save();
            }
            return $this->response->item($product, new ProductTransformer);
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
        $product = Product::findOrFail($id);

        $product->delete();
        $text = "producto eliminado";

        return response()->json(compact('text'), 200);
    }
}
