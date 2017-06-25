<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqKeyOnCroppingHash extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assets_croppings', function (Blueprint $table) {
            $table->string("cropping_hash", 255);
            $table->unique("cropping_hash");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets_croppings', function (Blueprint $table) {
            //
        });
    }
}
