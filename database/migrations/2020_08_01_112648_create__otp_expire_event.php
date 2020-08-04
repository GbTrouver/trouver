<?php

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
        // 0 = inactive_otp, 1 = active_otp
        // UPDATE user_otps SET status = 1, updated_at = CURRENT_TIMESTAMP();
        DB::unprepared("CREATE EVENT IF NOT EXISTS user_otps_expire_event
                        ON SCHEDULE EVERY 1 MINUTE
                        STARTS CURRENT_TIMESTAMP()
                        ON COMPLETION PRESERVE
                        COMMENT 'Expire all Otp whose time limit exceeds.'
                        DO
                            BEGIN
                                UPDATE user_otps SET status = 0, updated_at = CURRENT_TIMESTAMP() WHERE status = 1 AND expires_in < TIME_TO_SEC(TIMEDIFF(CURRENT_TIMESTAMP(), `created_at`));
                            END
                        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists();
        DB::unprepared("DROP EVENT user_otps_expire_event;");
    }
}
