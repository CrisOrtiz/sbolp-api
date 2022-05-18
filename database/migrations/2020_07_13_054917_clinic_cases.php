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
        Schema::connection('pgsql')->create('clinic_cases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('title');
            $table->longText('description');
            $table->longText('diagnostic');
            $table->longText('treatment_phase_one');
            $table->longText('procedure_phase_one');
            $table->boolean('hasSecondPhase')->default(false);
            $table->longText('treatment_phase_two')->nullable();
            $table->longText('procedure_phase_two')->nullable();
            $table->longText('conclusions');
            $table->longText('advices');
            $table->boolean('status')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
