<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

class EmoticoDataRowsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $assetDataType = DataType::where('slug', 'assets')->firstOrFail();

        $dataRow = $this->dataRow($assetDataType, 'id');
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

        $dataRow = $this->dataRow($assetDataType, 'uuid');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Uuid',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'order' => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($assetDataType, 'version');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Version',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 0,
                'order' => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($assetDataType, 'extension');
        if (!$dataRow->exists)
        {
            $dataRow->fill([
                'type' => 'text',
                'display_name' => 'Extension',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($assetDataType, 'created_at');

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

        $dataRow = $this->dataRow($assetDataType, 'updated_at');

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

        $dataRow = $this->dataRow($assetDataType, 'thumbnailList');
        if (!$dataRow->exists)
        {
            $dataRow->fill([
                'type' => 'emotico-thumbnaillist',
                'display_name' => 'ThumbnailList',
                'required' => 1,
                'browse' => 1,
                'read' => 1,
                'edit' => 1,
                'add' => 1,
                'delete' => 1,
                'details' => '',
                'order' => 7,
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
