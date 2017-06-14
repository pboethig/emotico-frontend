<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class EmoticoDatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__.'/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('EmoticoDataTypesTableSeeder');
        $this->seed('EmoticoDataRowsTableSeeder');
        $this->seed('EmoticoPermissionsTableSeeder');
        $this->seed('EmoticoMenuItemsTableSeeder');
    }
}
