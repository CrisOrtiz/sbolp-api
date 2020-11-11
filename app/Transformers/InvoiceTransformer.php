<?php
namespace App\Transformers;
use App\Models\Invoice;
use League\Fractal\TransformerAbstract;
use App\Transformers\InvoiceArticleTransformer;

class InvoiceTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = ['articles'
    ];
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];
    /**
     * @param Invoice $invoice
     * @return array
     */
    public function transform(Invoice $invoice)
    {
        return [
            'id' => $invoice->id,
            'number' => $invoice->number,
            'prefix' => $invoice->prefix,
            'datecreated' => $invoice->datecreated,
            'date' => $invoice->date,
            'total' => $invoice->total,
            'status' => $invoice->status,
            'client_id' => $invoice->client_id,
            'jelpi_id' => $invoice->jelpi_id,
        ];
    }

    public function includeArticles(Invoice $invoice)
    {
        $invoiceArticles = $invoice->articles()->get();
        return $this->collection($invoiceArticles, new InvoiceArticleTransformer());
    }
}

