<?php
namespace App\Transformers;
use App\Models\Sale;
use League\Fractal\TransformerAbstract;
use App\Transformers\SaleProductTransformer;

class SaleTransformer extends TransformerAbstract
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
    public function transform(Sale $sale)
    {
        return [
            'id' => $sale->id,
            'client_id' => $sale->client_id,
            'user_id' => $sale->user_id,
            'date' => $sale->date,
            'total' => $sale->total,
            'paid' => $sale->paid,
            'debt' => $sale->debt,
        ];
    }

    public function includeProducts(Sale $sale)
    {
        $saleProducts = $sale->products()->get();
        return $this->collection($saleProducts, new SaleProductTransformer());
    }
}

