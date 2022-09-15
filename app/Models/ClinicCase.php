<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;

class ClinicCase extends Model
{
    use SoftDeletes, UUID;
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
        return $this->hasMany(Comment::class, 'clinic_case_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'rel_id', 'id');
    }
}
