<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

/**
 * Class EmoticoDataRowsTableSeederAssetCroppings
 */
class EmoticoDataRowsTableSeederAssetCroppings extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $assetCroppingsDataType = DataType::where('slug', 'assets_croppings')->firstOrFail();

        $dataRow = $this->dataRow($assetCroppingsDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'number',
                'display_name' => 'ID',
                'required' => 1,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($assetCroppingsDataType, 'asset_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'select_dropdown',
                'display_name' => 'asset_id',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'order' => 2,
                'details'      => json_encode([
                    'default'  => '',
                    'null'     => '',
                    'options'  => [
                        '' => '-- None --',
                    ],
                    'relationship' => [
                        'key'   => 'id',
                        'label' => 'name',
                    ],
                ])
            ])->save();
        }


        $dataRow = $this->dataRow($assetCroppingsDataType, 'user_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'select_dropdown',
                'display_name' => 'user_id',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'order' => 2,
                'details'      => json_encode([
                    'default'  => '',
                    'null'     => '',
                    'options'  => [
                        '' => '-- None --',
                    ],
                    'relationship' => [
                        'key'   => 'id',
                        'label' => 'name',
                    ],
                ])
            ])->save();
        }
        
        $dataRow = $this->dataRow($assetCroppingsDataType, 'created_at');

        if (!$dataRow->exists)
        {
            $dataRow->fill([
                'type' => 'timestamp',
                'display_name' => 'created_at',
                'required' => 0,
                'browse' => 1,
                'read' => 1,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($assetCroppingsDataType, 'updated_at');

        if (!$dataRow->exists)
        {
            $dataRow->fill([
                'type' => 'timestamp',
                'display_name' => 'updated_at',
                'required' => 0,
                'browse' => 0,
                'read' => 0,
                'edit' => 0,
                'add' => 0,
                'delete' => 0,
                'details' => '',
                'order' => 6,
            ])->save();
        }
    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
                'data_type_id' => $type->id,
                'field'        => $field,
            ]);
    }
}
