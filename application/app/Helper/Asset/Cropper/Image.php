<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 22.06.17
 * Time: 18:22
 */

namespace App\Helper\Asset\Cropper;
use App\Models\Asset;


/**
 * Class Upload
 * @package App\Helper\Asset\Import
 */
class Image
{
    /**
     * @param Asset $asset
     * @return string
     */
    public static function getBase64Image(Asset $asset)
    {
        $imageContent = file_get_contents("http://172.17.0.1:8181/assets/65b7c42b060c114d83f13fb24a780a85/dsci1311.jpg");

        $base64 = base64_encode($imageContent);

        $image='data:image/jpg;base64,' . $base64;

        return $image;
    }
}