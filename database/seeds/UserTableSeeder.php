<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Image;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        

        $user = new User();
        $user->name = 'AdminName';
        $user->lastname = 'AdminLastname';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('password');      
        $user->role = 'ROLE_ADMIN';
        $user->image_name = 'img-profile-1.jpg';
        $user->save();

        $image = new Image();
        $image->rel_type = 'profile';
        $image->rel_id = $user->id;
        $image->image_url = env('APP_URL').'/img/users/img-'.$image->rel_type.'-'.$image->rel_id.'jpg';
        $image->save();

        $user = new User();
        $user->name = 'User';
        $user->lastname = 'UserLastname';
        $user->email = 'user@user.com';
        $user->password = Hash::make('password');      
        $user->role = 'ROLE_USER';
        $user->image_name = 'img-profile-2.jpg';
        $user->save();

        $image = new Image();
        $image->rel_type = 'profile';
        $image->rel_id = $user->id;
        $image->image_url = env('APP_URL').'/img/users/img-'.$image->rel_type.'-'.$image->rel_id.'jpg';
        $image->save();

    }
}
