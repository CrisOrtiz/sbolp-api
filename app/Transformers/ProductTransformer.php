<?php
namespace App\Transformers;
use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
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
     * @param Product $product
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'code' => $product->code,
            'description' => $product->description,
            'buy_price' => (double)$product->buy_price,
            'sell_price' => (double)$product->sell_price,
            'wholesale_price' => (double)$product->wholesale_price,
            'agency_1_stock' => (double)$product->agency_1_stock,
            'agency_2_stock' => (double)$product->agency_2_stock,
            'total_stock' => (double)$product->total_stock,
            'image_url' => $product->image_url,
        ];
    }
}