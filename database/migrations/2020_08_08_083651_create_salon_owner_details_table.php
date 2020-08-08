<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonOwnerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salon_owner_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salons_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('image')->nullable();
            $table->string('mobile', 20);
            $table->string('alt_mobile', 20)->nullable();
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
        Schema::dropIfExists('salon_owner_details');
    }
}
