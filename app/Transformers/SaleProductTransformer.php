<?php

namespace App\Transformers;

use App\Models\SaleProduct;
use League\Fractal\TransformerAbstract;

class SaleProductTransformer extends TransformerAbstract
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
     * @param SaleProduct $saleProduct
     * @return array
     */
    public function transform(SaleProduct $saleProduct)
    {
        return [
            'id' => $saleProduct->id,
            'sale_id' => $saleProduct->sale_id,
            'product_code' => $saleProduct->product_code,
            'qty' => $saleProduct->qty,
            'price' => $saleProduct->price,
        ];
    }
}