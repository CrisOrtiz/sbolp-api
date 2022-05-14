<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ClinicCase;
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
        for ($j = 0; $j < 2; $j++) {
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
            $image->image_url = '/img/users/img-' . $image->rel_type . '-' . $image->rel_id . 'jpg';
            $image->save();

            $clinicCase1 = new ClinicCase();
            $clinicCase1->user_id = $user->id;
            $clinicCase1->title = 'Mordida cruzada anterior Brackets';
            $clinicCase1->description = 'test description';
            $clinicCase1->diagnostic = 'test diagnostic';
            $clinicCase1->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase1->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase1->hasSecondPhase = false;
            $clinicCase1->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase1->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase1->conclusions = 'Conclusions';
            $clinicCase1->advices = 'Advices';
            $clinicCase1->status = true;
            $clinicCase1->save();

            $clinicCase2 = new ClinicCase();
            $clinicCase2->user_id = $user->id;
            $clinicCase2->title = 'Mordida cruzada posterior Pistas Composite';
            $clinicCase2->description = 'test description';
            $clinicCase2->diagnostic = 'test diagnostic';
            $clinicCase2->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase2->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase2->hasSecondPhase = false;
            $clinicCase2->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase2->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase2->conclusions = 'Conclusions';
            $clinicCase2->advices = 'Advices';
            $clinicCase2->status = true;
            $clinicCase2->save();

            $clinicCase3 = new ClinicCase();
            $clinicCase3->user_id = $user->id;
            $clinicCase3->title = 'Mordida cruzada anterior Quad Helix';
            $clinicCase3->description = 'test description';
            $clinicCase3->diagnostic = 'test diagnostic';
            $clinicCase3->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase3->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase3->hasSecondPhase = false;
            $clinicCase3->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase3->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase3->conclusions = 'Conclusions';
            $clinicCase3->advices = 'Advices';
            $clinicCase3->status = true;
            $clinicCase3->save();

            $clinicCase4 = new ClinicCase();
            $clinicCase4->user_id = $user->id;
            $clinicCase4->title = 'Mordida cruzada anterior Placa Progenie';
            $clinicCase4->description = 'test description';
            $clinicCase4->diagnostic = 'test diagnostic';
            $clinicCase4->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase4->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase4->hasSecondPhase = false;
            $clinicCase4->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase4->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase4->conclusions = 'Conclusions';
            $clinicCase4->advices = 'Advices';
            $clinicCase4->status = true;
            $clinicCase4->save();

            $clinicCase5 = new ClinicCase();
            $clinicCase5->user_id = $user->id;
            $clinicCase5->title = 'Mordida cruzada anterior Pistas Composite';
            $clinicCase5->description = 'test description';
            $clinicCase5->diagnostic = 'test diagnostic';
            $clinicCase5->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase5->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase5->hasSecondPhase = true;
            $clinicCase5->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase5->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase5->conclusions = 'Conclusions';
            $clinicCase5->advices = 'Advices';
            $clinicCase5->status = false;
            $clinicCase5->save();
        }

        for ($i = 0; $i < 5; $i++) {
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
            $image->image_url = '/img/users/img-' . $image->rel_type . '-' . $image->rel_id . 'jpg';
            $image->save();


            $clinicCase1 = new ClinicCase();
            $clinicCase1->user_id = $user->id;
            $clinicCase1->title = 'Mordida cruzada anterior Brackets';
            $clinicCase1->description = 'test description';
            $clinicCase1->diagnostic = 'test diagnostic';
            $clinicCase1->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase1->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase1->hasSecondPhase = false;
            $clinicCase1->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase1->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase1->conclusions = 'Conclusions';
            $clinicCase1->advices = 'Advices';
            $clinicCase1->status = true;
            $clinicCase1->save();

            $clinicCase2 = new ClinicCase();
            $clinicCase2->user_id = $user->id;
            $clinicCase2->title = 'Mordida cruzada posterior Pistas Composite';
            $clinicCase2->description = 'test description';
            $clinicCase2->diagnostic = 'test diagnostic';
            $clinicCase2->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase2->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase2->hasSecondPhase = false;
            $clinicCase2->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase2->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase2->conclusions = 'Conclusions';
            $clinicCase2->advices = 'Advices';
            $clinicCase2->status = true;
            $clinicCase2->save();

            $clinicCase3 = new ClinicCase();
            $clinicCase3->user_id = $user->id;
            $clinicCase3->title = 'Mordida cruzada anterior Quad Helix';
            $clinicCase3->description = 'test description';
            $clinicCase3->diagnostic = 'test diagnostic';
            $clinicCase3->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase3->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase3->hasSecondPhase = false;
            $clinicCase3->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase3->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase3->conclusions = 'Conclusions';
            $clinicCase3->advices = 'Advices';
            $clinicCase3->status = true;
            $clinicCase3->save();

            $clinicCase4 = new ClinicCase();
            $clinicCase4->user_id = $user->id;
            $clinicCase4->title = 'Mordida cruzada anterior Placa Progenie';
            $clinicCase4->description = 'test description';
            $clinicCase4->diagnostic = 'test diagnostic';
            $clinicCase4->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase4->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase4->hasSecondPhase = false;
            $clinicCase4->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase4->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase4->conclusions = 'Conclusions';
            $clinicCase4->advices = 'Advices';
            $clinicCase4->status = true;
            $clinicCase4->save();

            $clinicCase5 = new ClinicCase();
            $clinicCase5->user_id = $user->id;
            $clinicCase5->title = 'Mordida cruzada anterior Pistas Composite';
            $clinicCase5->description = 'test description';
            $clinicCase5->diagnostic = 'test diagnostic';
            $clinicCase5->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase5->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase5->hasSecondPhase = true;
            $clinicCase5->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase5->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase5->conclusions = 'Conclusions';
            $clinicCase5->advices = 'Advices';
            $clinicCase5->status = false;
            $clinicCase5->save();
        }
    }
}
