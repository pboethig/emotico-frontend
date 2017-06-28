<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddBrowserimagedataToAssetCroppings
 */
class AddBrowserimagedataToAssetCroppings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assets_croppings', function (Blueprint $table) {
            $table->text('browserimagedata');
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
            $table->dropColumn("browserimagedata");
        });
    }
}
