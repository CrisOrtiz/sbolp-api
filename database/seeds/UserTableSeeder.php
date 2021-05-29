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

       for ($j=0; $j < 2; $j++) {    
            $user = new User();
            $user->name = 'Admin' . $j;
            $user->lastname = 'AdminLastname';
            $user->email = 'admin'  . $j . '@admin.com';
            $user->password = Hash::make('password');      
            $user->role = 'ROLE_ADMIN';
            $user->status = true;
            $user->image_name = 'img-profile-1.jpg';
            $user->save();

            $image = new Image();
            $image->rel_type = 'profile';
            $image->rel_id = $user->id;
            $image->image_url = '/img/users/img-'.$image->rel_type.'-'.$image->rel_id.'jpg';
            $image->save();
       }

        for ($i=0; $i < 14; $i++) { 
            $user = new User();
            $user->name = 'User' . $i;
            $user->lastname = 'UserLastname';
            $user->email = 'user' . $i . '@user.com';
            $user->password = Hash::make('password');      
            $user->role = 'ROLE_USER';
            $user->status = false;
            $user->image_name = 'default-user.jpg';
            $user->save();

            $image = new Image();
            $image->rel_type = 'profile';
            $image->rel_id = $user->id;
            $image->image_url = '/img/users/img-'.$image->rel_type.'-'.$image->rel_id.'jpg';
            $image->save();
        }
    }
}
