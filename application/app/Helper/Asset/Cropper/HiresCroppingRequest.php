<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 27.06.17
 * Time: 19:22
 */

namespace App\Helper\Asset\Cropper;

use App\Models\Asset;
use App\Models\AssetsCroppings;

/**
 * Class HigresCroppingRequest
 * @package App\Helper\Asset\Cropper
 */
class HiresCroppingRequest
{
    /**
     * @var Asset
     */
    public $payload;

    /**
     * HigresCroppingRequest constructor.
     * @param AssetsCroppings $cropping
     */
    public function __construct(AssetsCroppings $cropping)
    {
        $this->payload = new \stdClass();

        $this->payload->asset = $cropping->asset()->attributesToArray();

        $this->payload->canvasdata = new \stdClass();

        $this->payload->canvasdata = json_decode($cropping->canvasdata);

        $this->payload->browserimagedata = json_decode($cropping->browserimagedata);

        $this->payload->canvasdata->hash = $cropping->cropping_hash;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->payload);
    }
}