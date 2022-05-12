<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClinicCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('clinic_cases', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('title');
            $table->string('description');
            $table->string('diagnostic');
            $table->string('treatment_phase_one');
            $table->string('procedure_phase_one');
            $table->boolean('hasSecondPhase')->default(false);
            $table->string('treatment_phase_two')->nullable();
            $table->string('procedure_phase_two')->nullable();
            $table->string('conclusions');
            $table->string('advices');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('clinic_cases');
    }
}
