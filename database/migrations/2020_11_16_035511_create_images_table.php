<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('images', function (Blueprint $table) {
            $table->id();
            $table->string('rel_type');
            $table->string('rel_id');
            $table->string('image_url', 255)->default('/img/users/default-user.jpg');
            $table->string('image_name', 255)->default('default-user.jpg');
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
        Schema::dropIfExists('images');
    }
}
