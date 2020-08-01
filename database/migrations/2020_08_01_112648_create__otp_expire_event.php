<?php

use DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpExpireEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('_otp_expire_event', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        // Need to complete this
        // DB::unprepared("CREATE EVENT IF NOT EXISTS user_otp_expire ON SCHEDULE EVERY 1 Minute ON ENABLE COMMENT 'Deletes all record redimento_pack from 3 months ago' DO BEGIN DELETE FROM users_otp WHERE data_hora < DATE_SUB(NOW(), INTERVAL 3 MONTH); END")
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_otp_expire_event');
    }
}
