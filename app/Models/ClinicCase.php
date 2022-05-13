<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;

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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'clinic_case_id', 'id');
    }
}
