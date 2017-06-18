<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 18.06.17
 * Time: 12:06
 */

namespace App\Helper\Asset\Import\Dropzone;
use App\Repository\Emotico\Client;
use App\Repository\Emotico\MediaconverterConfig;

/**
 * Class Config
 * @package App\Helper\Asset\Import\Dropzone
 */
class Config
{
    /**
     * @var string
     */
    public $url='';

    /**
     * @var string
     */
    public $dictDefaultMessage='messages.dropyourAssetsHere';

    /**
     * @var string
     */
    public $acceptedFiles='';

    /**
     * @var string
     */
    public $paramName='file';

    /**
     * @var int
     */
    public $maxFilesize = 600;

    /**
     * @var bool
     */
    public $addRemoveLinks=false;

    /**
     * @var bool
     */
    public $uploadMultiple = true;

    /**
     * @var int
     */
    public $parallelUploads = 20;

    /**
     * @var int
     */
    public $maxFiles=1000;

    /**
     * @var bool
     */
    public $autoProcessQueue=true;

    /**
     * @var string
     */
    public $previewTemplate='<div></div>';

    /**
     * @var \stdClass
     */
    public $headers = null;

    /**
     * Read app onfig and set propertyvalues
     *
     * Config constructor.
     */
    public function __construct()
    {
        $scope = 'mediaconverter.import.dropzone.';

        foreach ($this as $propertyName=>$value)
        {
            if(isset(config('app')[$scope . $propertyName]))
            {
                $this->$propertyName = config('app')[$scope . $propertyName];
            }
        }

        $this->headers = json_decode(config('app')[$scope . 'headers']);

        $this->dictDefaultMessage = __(config('app')[$scope . 'dictDefaultMessage']);

        if(empty($this->acceptedFiles))
        {
            $mediaconverterConfig = new MediaconverterConfig(new \App\Repository\Emotico\Config());

            $this->acceptedFiles = $mediaconverterConfig->getAllSupportedFormatsAsString();
        }

        $this->url = __(config('app')['mediaconverter.public.web.url'] . '/assets/store');
    }
}