<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Models\User;

class Notification extends Model
{
    use UUID;
    protected $connection = 'pgsql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
