<?php

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $patient = new Patient();
        $patient->ci = '6984806';
        $patient->name = 'Patient name';
        $patient->last_name = 'Patient lastname';
        $patient->save();
    }
}
