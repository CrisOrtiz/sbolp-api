<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicCase extends Model
{
    protected $connection = 'mysql';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clinic_cases';

    public function user()
    {
        return $this->belongsTo(User::class,  'user_id', 'id');
    }

    /*public function odontogram()
    {
        return $this->hasMany(Odontogram::class, 'patient_id', 'id');
    }*/
}
