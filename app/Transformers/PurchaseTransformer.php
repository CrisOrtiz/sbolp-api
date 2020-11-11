<?php
namespace App\Transformers;
use App\Models\Purchase;
use League\Fractal\TransformerAbstract;
use App\Transformers\PurchaseProductTransformer;

class PurchaseTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = ['items'
    ];
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];
    /**
     * @param Purchase $purchase
     * @return array
     */
    public function transform(Purchase $purchase)
    {
        return [
            'id' => $purchase->id,
            'user_id' => $purchase->user_id,
            'date' => $purchase->date,
            'total' => $purchase->total,
            'paid' => $purchase->paid,
            'debt' => $purchase->debt,
            
        ];
    }

    public function includeProducts(Purchase $purchase)
    {
        $purchaseProducts = $purchase->products()->get();
        return $this->collection($purchaseProducts, new PurchaseProductTransformer());
    }
}

