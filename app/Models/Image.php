<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Image extends Model
{
    use UUID;

    protected $connection = 'mysql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

    public function clinicCase()
    {
        return $this->belongsTo(ClinicCase::class, 'rel_id', 'id');
    }
}
