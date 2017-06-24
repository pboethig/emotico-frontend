<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 22.06.17
 * Time: 18:22
 */

namespace App\Helper\Asset\Cropper;
use App\Helper\Asset\Url;
use App\Models\Asset;


/**
 * Class Upload
 * @package App\Helper\Asset\Import
 */
class Image
{
    /**
     * @param Asset $asset
     * @param string $extension
     * @return string
     */
    public static function getBase64Image(Asset $asset, $extension='')
    {
        $imageContent = file_get_contents(Url::getHighresUrl($asset, $extension));

        $base64 = base64_encode($imageContent);

        if(empty($extension)) $extension='jpg';

        $image='data:image/'.$extension.';base64,' . $base64;

        return $image;
    }
}