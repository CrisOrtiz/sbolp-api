<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql')->create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('clinic_case_id');
            $table->string('content');
            $table->string('owner')->nullable();
            $table->timestamps();

            $table->foreign('user_id') ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('clinic_case_id') ->references('id')->on('clinic_cases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('comments');
    }
}
