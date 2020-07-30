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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->tinyInteger('role_id')->unsigned();
            $table->string('mobile_no', 15);
            $table->string('password')->nullable();
            $table->text('token')->nullable();
            $table->tinyInteger('gender')->default('3')->comment('1=man, 2=woman, 3=other');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->integer('postal_code')->unsigned()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->comment('user status, 0=inactive, 1=active, 2=on_hold')->default('1');
            $table->rememberToken();
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
