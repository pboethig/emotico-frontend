<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAssetTable
 */
class CreateAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table)
        {
            $table->increments('id');
            $table->text('uuid');
            $table->text('version');
            $table->text('extension');
            $table->timestamps();
            $table->longText('thumbnailList');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets', function (Blueprint $table)
        {
            Schema::dropIfExists('assets');
        });
    }
}
