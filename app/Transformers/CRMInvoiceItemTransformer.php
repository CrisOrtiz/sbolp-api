<?php
namespace App\Transformers;
use App\Models\CRMInvoiceItem;
use League\Fractal\TransformerAbstract;

class CRMInvoiceItemTransformer extends TransformerAbstract
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
     * @param Invoice $invoice
     * @return array
     */
    public function transform(CRMInvoiceItem $crminvoiceitem)
    {
        return [
            'id' => $crminvoiceitem->id,
            'rel_id' => $crminvoiceitem->rel_id,
            'description' => $crminvoiceitem->description,
            'long_description' => $crminvoiceitem->long_description,
            'qty' => $crminvoiceitem->qty,
            'rate' => $crminvoiceitem->rate,
            'unit' => $crminvoiceitem->unit,
            'item_order' => $crminvoiceitem->item_order
        ];
    }
}

