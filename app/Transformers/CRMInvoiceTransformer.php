<?php
namespace App\Transformers;
use App\Models\CRMInvoice;
use League\Fractal\TransformerAbstract;

class CRMInvoiceTransformer extends TransformerAbstract
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
    protected $availableIncludes = ['items'];
    /**
     * @param CRMInvoice $crmInvoice
     * @return array
     */
    public function transform(CRMInvoice $crmInvoice)
    {
        return [
            'id' => $crmInvoice->id,
            'crm_id' => $crmInvoice->crm_id,
            'prefix' => $crmInvoice->prefix,
            'datecreated' => $crmInvoice->datecreated,
            'date' => $crmInvoice->date,
            'status' => $crmInvoice->status,
            'last_update' => $crmInvoice->last_update,
        ];
    }


    public function includeItems(CRMInvoice $crminvoice)
    {
        $items = $crminvoice->items()->get();
        return $this->collection($items, new CRMInvoiceItemTransformer());

    }
}

