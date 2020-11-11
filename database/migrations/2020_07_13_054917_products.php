<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description', 255);
            $table->double('buy_price');
            $table->double('sell_price');
            $table->double('wholesale_price');
            $table->integer('agency_1_stock')->nullable();
            $table->integer('agency_2_stock')->nullable();
            $table->integer('total_stock')->nullable();
            $table->string('image_url')->nullable();
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
        Schema::connection('mysql')->dropIfExists('products');
    }
}
