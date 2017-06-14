<?php

namespace App\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class EmoticoThumbnailListHandler extends AbstractHandler
{
    protected $codename = 'emotico-thumbnaillist';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.emoticothumbnaillist', [
            'row'             => $row,
            'options'         => $options,
            'dataType'        => $dataType,
            'dataTypeContent' => $dataTypeContent,
        ]);
    }
}
