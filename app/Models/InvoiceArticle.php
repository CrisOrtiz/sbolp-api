<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceArticle extends Model
{
    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoice_articles';

}
