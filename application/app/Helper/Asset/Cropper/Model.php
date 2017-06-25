<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 24.06.17
 * Time: 22:22
 */

namespace App\Helper\Asset\Cropper;

/**
 * Class Model
 * @package App\Helper\Asset\Cropper
 */
class Model
{
    /**
     * @param \stdClass $message
     * @return string
     */
    public static function getAssetUiidFromEventMessage(\stdClass $message) : string
    {
        return explode("_", $message->version)[0];
    }

}