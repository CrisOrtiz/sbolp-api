<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Invoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('prefix');
            $table->date('datecreated');
            $table->date('date');
            $table->string('total');
            $table->string('status');
            $table->string('client_id');
            $table->string('jelpi_id');
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
        Schema::connection('mysql')->dropIfExists('invoices');
    }
}
