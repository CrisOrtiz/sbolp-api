<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jelpi extends Model
{
    protected $connection = 'pgsql';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jelpis';
}
