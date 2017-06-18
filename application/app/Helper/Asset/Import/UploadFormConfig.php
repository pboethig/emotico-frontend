<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 18.06.17
 * Time: 02:52
 */

namespace App\Helper\Asset\Import;

use App\Repository\Emotico\Config;

/**
 * Class DropzoneConfig
 * @package App\Helper\Import
 */
class UploadFormConfig
{
    /**
     * @var string
     */
    public $assetStoreUrl ='';

    /**
     * @var string
     */
    public $triggerProgressUrl='';

    /**
     * @var string
     */
    public $pingInDesignServerUrl='';

    /**
     * @var string
     */
    public $websocketUrl = '';

    /**
     * @var string
     */
    public $allowedFormats = '';

    /**
     * @var string
     */
    public $imagethumbnailConsumerCommand = '';

    /**
     * @var string
     */
    public $videothumbnailConsumerCommand = '';

    /**
     * @var string
     */
    public $indesignthumbnailConsumerCommand = '';

    /**
     * @var array
     */
    public $dropzoneConfig = [];

    /**
     * DropzoneConfig constructor.
     */
    public function __construct()
    {
        $queueConfig = new Config();

        $this->assetStoreUrl = $queueConfig::$weburl . "/assets/store";

        $this->triggerProgressUrl = $queueConfig::$weburl . "/assets/process";

        $this->pingInDesignServerUrl = $queueConfig::$weburl . "/indesignserver/ping";

        $this->websocketUrl = $queueConfig::$websocketUrl;

        $this->allowedFormats = $queueConfig::$allowedUploadFormats;

        $this->imagethumbnailConsumerCommand = $queueConfig::$imagethumbnailConsumerCommand;

        $this->videothumbnailConsumerCommand = $queueConfig::$videothumbnailConsumerCommand;

        $this->indesignthumbnailConsumerCommand = $queueConfig::$indesignthumbnailConsumerCommand;

        $this->dropzoneConfig['initmessage'] = __('messages.dropyourAssetsHere');
    }
}