<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class EmoticoPermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'browse_assets',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => null,
            ]);
        }

        Permission::generateFor('assets');
    }
}
