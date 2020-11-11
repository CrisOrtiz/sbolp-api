<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('client_id');
            $table->string('user_id');
            $table->string('date');
            $table->double('total');
            $table->double('paid');
            $table->double('debt');
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
        Schema::connection('mysql')->dropIfExists('sales');
    }
}
