<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseProduct;

class Purchase extends Model
{
    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales';

    public function products()
    {
        return $this->hasMany(PurchaseProduct::class, 'purchase_id', 'id');
    }
}
