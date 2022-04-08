<?php

use App\Models\ClinicCase;
use Illuminate\Database\Seeder;

class ClinicCaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '1';
        $clinicCase->name = 'Mordida cruzada anterior Brackets';
        $clinicCase->status = true;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '2';
        $clinicCase->name = 'Mordida cruzada posterior Pistas Composite';
        $clinicCase->status = true;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '3';
        $clinicCase->name = 'Mordida cruzada anterior Quad Helix';
        $clinicCase->status = true;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '4';
        $clinicCase->name = 'Mordida cruzada anterior Placa Progenie';
        $clinicCase->status = true;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '1';
        $clinicCase->name = 'Mordida cruzada anterior Pistas Composite';
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '2';
        $clinicCase->name = 'Mordida cruzada anterior';
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '1';
        $clinicCase->name = 'Mordida cruzada anterior Brackets';
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '2';
        $clinicCase->name = 'Mordida cruzada posterior Pistas Composite';
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '3';
        $clinicCase->name = 'Mordida cruzada anterior Quad Helix';
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '4';
        $clinicCase->name = 'Mordida cruzada anterior Placa Progenie';
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '1';
        $clinicCase->name = 'Mordida cruzada anterior Pistas Composite';
        $clinicCase->save();
    }
}
