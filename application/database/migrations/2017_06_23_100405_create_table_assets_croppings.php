<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAssetsCroppings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets_croppings', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('asset_id')->unsigned()->nullable()->references('id')->on('assets')->onDelete('set null');
            $table->integer('user_id')->unsigned()->nullable()->references('id')->on('users')->onDelete('set null');
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
        Schema::table('assets_croppings', function (Blueprint $table) {
            Schema::dropIfExists('assets_croppings');
        });
    }
}
