<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serializers\NoDataArraySerializer;
use App\Transformers\InvoiceTransformer;
use App\Models\CRMInvoice;
use App\Models\Invoice;
use App\Models\InvoiceArticle;
use Artisan;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with('articles')->get();
        $resource = 'invoices';

        return $this->collection($invoices, new InvoiceTransformer, function ($resource, $fractal) {
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
        $invoice = Invoice::findOrFail($id);

        return $this->item($invoice, new InvoiceTransformer, function ($resource, $fractal) {
            $fractal->setSerializer(new NoDataArraySerializer());
        });
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = new Invoice();
       
        $invoice->number = "0";
        $invoice->prefix = $request->prefix;
        $invoice->datecreated = $request->datecreated;
        $invoice->date = $request->date;
        $invoice->total = $request->total;
        $invoice->status = $request->status;
        $invoice->client_id = $request->client_id;
        $invoice->jelpi_id = $request->jelpi_id;
        $invoice->save();

        $invoice->number = $invoice->id;
        $invoice->save();


        for ($i=0; $i < count($request->articles) ; $i++) { 
            $invoice_article = new InvoiceArticle();

            $invoice_article->item_order = $i+1;
            $invoice_article->rel_id = $invoice->id;
            $invoice_article->rel_type = $request->articles[$i]['rel_type'];
            $invoice_article->description = $request->articles[$i]['description'];
            $invoice_article->qty = $request->articles[$i]['qty'];
            $invoice_article->rate = $request->articles[$i]['rate'];
            $invoice_article->unit = $request->articles[$i]['unit'];
            $invoice_article->save();
        }
        

        $resource = 'invoice';

        return $this->item($invoice, new InvoiceTransformer, function ($resource, $fractal) {
            $fractal->setSerializer(new NoDataArraySerializer());
        });
    
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
        $invoice = Invoice::findOrFail($id);

        $invoice->number = $request->number;
        $invoice->prefix = $request->prefix;
        $invoice->datecreated = $request->datecreated;
        $invoice->date = $request->date;
        $invoice->total = $request->total;
        $invoice->status = $request->status;
        $invoice->client_id = $request->client_id;
        $invoice->jelpi_id = $request->jelpi_id;
        $invoice->save();

        for ($i=0; $i < count($request->articles) ; $i++) { 
            $invoice_article = InvoiceArticle::find($request->articles[$i]['id']);
            
            if(!$invoice_article){
                $invoice_article = new InvoiceArticle();
            }
            $invoice_article->rel_id = $invoice->id;
            $invoice_article->rel_type = $request->articles[$i]['rel_type'];
            $invoice_article->description = $request->articles[$i]['description'];
            $invoice_article->qty = $request->articles[$i]['qty'];
            $invoice_article->rate = $request->articles[$i]['rate'];
            $invoice_article->unit = $request->articles[$i]['unit'];
            $invoice_article->item_order = strval($i+1);
            $invoice_article->save();
        }
        return $this->item($invoice, new InvoiceTransformer, function ($resource, $fractal) {
            $fractal->setSerializer(new NoDataArraySerializer());
        });
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
      
        $invoice->delete();

        for ($i=0; $i < count($request->articles) ; $i++) { 
            $invoice = InvoiceArticle::findOrFail($request->articles[$i]['id']);
      
            $invoice->delete();
        }

        $text = "invoice eliminado";

        return response()->json(compact('text'), 200);
    }


}
