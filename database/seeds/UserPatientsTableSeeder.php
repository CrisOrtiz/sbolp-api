<?php

use App\Models\UserPatient;
use Illuminate\Database\Seeder;

class UserPatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userPatient = new UserPatient();
        $userPatient->user_id = 1;
        $userPatient->patient_id = 1;
        $userPatient->status = 'public';
        $userPatient->save();
    }
}
