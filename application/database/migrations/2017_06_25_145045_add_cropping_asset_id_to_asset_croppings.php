<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCroppingAssetIdToAssetCroppings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assets_croppings', function (Blueprint $table) {
            $table->integer('cropping_asset_id')->unsigned()->nullable()->references('id')->on('assets')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets_croppings', function (Blueprint $table)
        {
            $table->dropColumn("cropping_asset_id");
        });
    }
}
