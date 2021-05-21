<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $connection = 'mysql';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patients';

    /*public function history()
    {
        return $this->hasMany(History::class, 'patient_id', 'id');
    }

    public function odontogram()
    {
        return $this->hasMany(Odontogram::class, 'patient_id', 'id');
    }*/
}
