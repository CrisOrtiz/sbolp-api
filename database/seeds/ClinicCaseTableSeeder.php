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
        $clinicCase->title = 'Mordida cruzada anterior Brackets';
        $clinicCase->description = 'test description';
        $clinicCase->diagnostic = 'test diagnostic';
        $clinicCase->treatment_phase_one = 'Test treatment text phase one';
        $clinicCase->procedure_phase_one = 'Test procedure text phase one';
        $clinicCase->hasSecondPhase = false;
        $clinicCase->treatment_phase_two = 'Test treatment text phase two';
        $clinicCase->procedure_phase_two = 'Test procedure text phase two';
        $clinicCase->conclusions = 'Conclusions';
        $clinicCase->advices = 'Advices';
        $clinicCase->status = true;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '2';
        $clinicCase->title = 'Mordida cruzada posterior Pistas Composite';
        $clinicCase->description = 'test description';
        $clinicCase->diagnostic = 'test diagnostic';
        $clinicCase->treatment_phase_one = 'Test treatment text phase one';
        $clinicCase->procedure_phase_one = 'Test procedure text phase one';
        $clinicCase->hasSecondPhase = false;
        $clinicCase->treatment_phase_two = 'Test treatment text phase two';
        $clinicCase->procedure_phase_two = 'Test procedure text phase two';
        $clinicCase->conclusions = 'Conclusions';
        $clinicCase->advices = 'Advices';
        $clinicCase->status = true;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '3';
        $clinicCase->title = 'Mordida cruzada anterior Quad Helix';
        $clinicCase->description = 'test description';
        $clinicCase->diagnostic = 'test diagnostic';
        $clinicCase->treatment_phase_one = 'Test treatment text phase one';
        $clinicCase->procedure_phase_one = 'Test procedure text phase one';
        $clinicCase->hasSecondPhase = false;
        $clinicCase->treatment_phase_two = 'Test treatment text phase two';
        $clinicCase->procedure_phase_two = 'Test procedure text phase two';
        $clinicCase->conclusions = 'Conclusions';
        $clinicCase->advices = 'Advices';
        $clinicCase->status = true;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '4';
        $clinicCase->title = 'Mordida cruzada anterior Placa Progenie';
        $clinicCase->description = 'test description';
        $clinicCase->diagnostic = 'test diagnostic';
        $clinicCase->treatment_phase_one = 'Test treatment text phase one';
        $clinicCase->procedure_phase_one = 'Test procedure text phase one';
        $clinicCase->hasSecondPhase = false;
        $clinicCase->treatment_phase_two = 'Test treatment text phase two';
        $clinicCase->procedure_phase_two = 'Test procedure text phase two';
        $clinicCase->conclusions = 'Conclusions';
        $clinicCase->advices = 'Advices';
        $clinicCase->status = true;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '1';
        $clinicCase->title = 'Mordida cruzada anterior Pistas Composite';
        $clinicCase->description = 'test description';
        $clinicCase->diagnostic = 'test diagnostic';
        $clinicCase->treatment_phase_one = 'Test treatment text phase one';
        $clinicCase->procedure_phase_one = 'Test procedure text phase one';
        $clinicCase->hasSecondPhase = true;
        $clinicCase->treatment_phase_two = 'Test treatment text phase two';
        $clinicCase->procedure_phase_two = 'Test procedure text phase two';
        $clinicCase->conclusions = 'Conclusions';
        $clinicCase->advices = 'Advices';
        $clinicCase->status = false;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '2';
        $clinicCase->title = 'Mordida cruzada anterior';
        $clinicCase->description = 'test description';
        $clinicCase->diagnostic = 'test diagnostic';
        $clinicCase->treatment_phase_one = 'Test treatment text phase one';
        $clinicCase->procedure_phase_one = 'Test procedure text phase one';
        $clinicCase->hasSecondPhase = true;
        $clinicCase->treatment_phase_two = 'Test treatment text phase two';
        $clinicCase->procedure_phase_two = 'Test procedure text phase two';
        $clinicCase->conclusions = 'Conclusions';
        $clinicCase->advices = 'Advices';
        $clinicCase->status = false;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '1';
        $clinicCase->title = 'Mordida cruzada anterior Brackets';
        $clinicCase->description = 'test description';
        $clinicCase->diagnostic = 'test diagnostic';
        $clinicCase->treatment_phase_one = 'Test treatment text phase one';
        $clinicCase->procedure_phase_one = 'Test procedure text phase one';
        $clinicCase->hasSecondPhase = false;
        $clinicCase->treatment_phase_two = 'Test treatment text phase two';
        $clinicCase->procedure_phase_two = 'Test procedure text phase two';
        $clinicCase->conclusions = 'Conclusions';
        $clinicCase->advices = 'Advices';
        $clinicCase->status = false;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '2';
        $clinicCase->title = 'Mordida cruzada posterior Pistas Composite';
        $clinicCase->description = 'test description';
        $clinicCase->diagnostic = 'test diagnostic';
        $clinicCase->treatment_phase_one = 'Test treatment text phase one';
        $clinicCase->procedure_phase_one = 'Test procedure text phase one';
        $clinicCase->hasSecondPhase = false;
        $clinicCase->treatment_phase_two = 'Test treatment text phase two';
        $clinicCase->procedure_phase_two = 'Test procedure text phase two';
        $clinicCase->conclusions = 'Conclusions';
        $clinicCase->advices = 'Advices';
        $clinicCase->status = false;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '3';
        $clinicCase->title = 'Mordida cruzada anterior Quad Helix';
        $clinicCase->description = 'test description';
        $clinicCase->diagnostic = 'test diagnostic';
        $clinicCase->treatment_phase_one = 'Test treatment text phase one';
        $clinicCase->procedure_phase_one = 'Test procedure text phase one';
        $clinicCase->hasSecondPhase = false;
        $clinicCase->treatment_phase_two = 'Test treatment text phase two';
        $clinicCase->procedure_phase_two = 'Test procedure text phase two';
        $clinicCase->conclusions = 'Conclusions';
        $clinicCase->advices = 'Advices';
        $clinicCase->status = false;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '4';
        $clinicCase->title = 'Mordida cruzada anterior Placa Progenie';
        $clinicCase->description = 'test description';
        $clinicCase->diagnostic = 'test diagnostic';
        $clinicCase->treatment_phase_one = 'Test treatment text phase one';
        $clinicCase->procedure_phase_one = 'Test procedure text phase one';
        $clinicCase->hasSecondPhase = false;
        $clinicCase->treatment_phase_two = 'Test treatment text phase two';
        $clinicCase->procedure_phase_two = 'Test procedure text phase two';
        $clinicCase->conclusions = 'Conclusions';
        $clinicCase->advices = 'Advices';
        $clinicCase->status = false;
        $clinicCase->save();

        $clinicCase = new ClinicCase();
        $clinicCase->user_id = '1';
        $clinicCase->title = 'Mordida cruzada anterior Pistas Composite';
        $clinicCase->description = 'test description';
        $clinicCase->diagnostic = 'test diagnostic';
        $clinicCase->treatment_phase_one = 'Test treatment text phase one';
        $clinicCase->procedure_phase_one = 'Test procedure text phase one';
        $clinicCase->hasSecondPhase = false;
        $clinicCase->treatment_phase_two = 'Test treatment text phase two';
        $clinicCase->procedure_phase_two = 'Test procedure text phase two';
        $clinicCase->conclusions = 'Conclusions';
        $clinicCase->advices = 'Advices';
        $clinicCase->status = false;
        $clinicCase->save();
    }
}
