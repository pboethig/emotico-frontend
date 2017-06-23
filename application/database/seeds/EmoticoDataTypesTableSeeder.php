<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class EmoticoDataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'assets');

        if (!$dataType->exists)
        {
            $dataType->fill([
                'name' => 'assets',
                'display_name_singular' => 'Asset',
                'display_name_plural' => 'Assets',
                'icon' => 'voyager-photos',
                'model_name' => 'App\\Models\\Asset',
                'controller' => '',
                'generate_permissions' => 1,
                'description' => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'assets_croppings');

        if (!$dataType->exists) {
            $dataType->fill([
                'name' => 'assets_croppings',
                'display_name_singular' => 'AssetCropping',
                'display_name_plural' => 'AssetCroppings',
                'icon' => 'voyager-photos',
                'model_name' => 'App\\Models\\AssetCropping',
                'controller' => 'AssetController',
                'generate_permissions' => 1,
                'description' => 'Here you can crop your image assets',
            ])->save();
        }
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
