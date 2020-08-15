<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salons', function (Blueprint $table) {
            $table->string('lat', 20)->nullable()->comment('latitude of salon')->after('postal_code');
            $table->string('lng', 20)->nullable()->comment('longitude of salon')->after('lat');
            $table->softDeletes()->after('updated_at');
        });

        Schema::table('salon_owner_details', function (Blueprint $table) {
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salons', function (Blueprint $table) {
            $table->dropColumn('lat');
            $table->dropColumn('lng');
            $table->dropSoftDeletes();
        });

        Schema::table('salon_owner_details', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
