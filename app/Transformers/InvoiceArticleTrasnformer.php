<?php
namespace App\Transformers;
use App\Models\InvoiceArticle;
use League\Fractal\TransformerAbstract;

class InvoiceArticleTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
    ];
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];
    /**
     * @param InvoiceArticle $invoiceArticle
     * @return array
     */
    public function transform(InvoiceArticle $invoiceArticle)
    {
        return [
            'id' => $invoiceArticle->id,
            'rel_id' => $invoiceArticle->rel_id,
            'rel_type' => $invoiceArticle->rel_type,
            'description' => $invoiceArticle->description,
            'qty' => $invoiceArticle->qty,
            'rate' => $invoiceArticle->rate,
            'unit' => $invoiceArticle->unit,
            'item_order' => $invoiceArticle->item_order,
        ];
    }
}

