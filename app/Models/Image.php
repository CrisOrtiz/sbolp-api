<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $connection = 'pgsql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

    public function user()
    {
        return $this->belongsTo(User::class,  'rel_id', 'id');
    }
}
