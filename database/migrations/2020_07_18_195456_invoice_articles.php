<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvoiceArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('invoice_articles', function (Blueprint $table) {
            $table->id();
            $table->string('rel_id');
            $table->string('rel_type');
            $table->string('description');
            $table->string('qty')->nullable();
            $table->string('rate');
            $table->string('unit')->nullable();
            $table->string('item_order');
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
        Schema::connection('mysql')->dropIfExists('invoice_articles');
    }
}
