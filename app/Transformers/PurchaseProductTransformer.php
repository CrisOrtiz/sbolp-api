<?php

namespace App\Transformers;

use App\Models\PurchaseItem;
use League\Fractal\TransformerAbstract;

class PurchaseItemTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * @param PurchaseProduct $purchaseProduct
     * @return array
     */
    public function transform(PurchaseProduct $purchaseProduct)
    {
        return [
            'id' => $purchaseProduct->id,
            'purchase_id' => $purchaseProduct->purchase_id,
            'product_code' => $purchaseProduct->product_code,
            'qty' => $purchaseProduct->qty,
            'price' => $purchaseProduct->price,
        ];
    }
}
