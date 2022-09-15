<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SaleProduct;

class Sale extends Model
{
    protected $connection = 'pgsql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales';

    public function products()
    {
        return $this->hasMany(SaleProduct::class, 'sale_id', 'id');
    }
}
