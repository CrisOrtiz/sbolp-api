<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceArticle;

class Invoice extends Model
{
    protected $connection = 'pgsql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    public function articles()
    {
        return $this->hasMany(InvoiceArticle::class, 'rel_id', 'id')->where('rel_type', 'invoice');
    }
}
