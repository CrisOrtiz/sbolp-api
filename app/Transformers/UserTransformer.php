<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\NotificationTransformer;
use App\Models\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'notifications',
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'notifications',
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'gender' => $user->gender,
            'isDoctor' => $user->isDoctor,
            'role' => $user->role,
            'email_verified_at' => $user->email_verified_at,
            'status' => $user->status,
            'hasUnreadNotifications' => $user->hasUnreadNotifications,
            'image_url' => $user->image_url,
        ];
    }

    
    public function includeNotifications(User $user)
    {
        $notifications = $user->notifications()->get();
        return $this->item($notifications, new NotificationTransformer());
    }
}