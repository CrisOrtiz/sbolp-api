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
        Schema::create('images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('rel_type');
            $table->uuid('rel_id');
            $table->string('image_url', 255)->default('/img/users/default-user.jpg');
            $table->string('image_name', 255)->default('default-user.jpg');
            $table->string('section', 255)->default('none');
            $table->timestamps();

            $table->foreign('rel_id')->references('id')->on('users');
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
