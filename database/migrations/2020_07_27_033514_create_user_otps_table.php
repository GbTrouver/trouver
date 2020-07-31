<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_otps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('otp')->unsigned();
            $table->tinyInteger('type')->comment('otp_type, 1=register_otp, 2=login_otp, 3=forgot_password_otp, 4=others_otp')->default('4');
            $table->tinyInteger('status')->comment('0=inactive, 1=active')->default('1');
            $table->integer('expires_in')->comment('in seconds')->default(300);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_otps');
    }
}
