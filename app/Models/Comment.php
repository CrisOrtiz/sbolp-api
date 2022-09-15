<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClinicCase;
use App\Models\User;
use App\Traits\UUID;

class Comment extends Model
{
    use UUID;
    
    protected $connection = 'pgsql';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    public function clinicCase()
    {
        return $this->belongsTo(ClinicCase::class, 'clinic_case_id', 'id');
    }
}
