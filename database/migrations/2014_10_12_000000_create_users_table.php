<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('gender')->nullable();
            $table->boolean('isDoctor')->default(true);
            $table->string('role')->default('ROLE_USER');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); 
            $table->boolean('status');      
            $table->boolean('hasUnreadNotifications')->default(false);                  
            $table->string('phone')->nullable();      
            $table->string('image_url', 255)->default('img/users/default-user.jpg');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
