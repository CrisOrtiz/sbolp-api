<?php

use App\Models\UserCase;
use Illuminate\Database\Seeder;

class UserCasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userPatient = new UserCase();
        $userPatient->user_id = 1;
        $userPatient->case_id = 1;
        $userPatient->status = 'public';
        $userPatient->save();
    }
}
