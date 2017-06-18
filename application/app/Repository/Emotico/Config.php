<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 16.06.17
 * Time: 14:33
 */

namespace App\Repository\Emotico;

class Config
{
    /**
     * @var string
     */
    public static $weburl;

    /**
     * @var string
     */
    public static $websocketUrl;

    /**
     * @var string
     */
    public static $imageThumbnailQueue;

    /**
     * @var string
     */
    public static $indesignThumbnailQueue;

    /**
     * @var string
     */
    public static $videoThumbnailQueue;

    /**
     * @var string
     */
    public static $imagethumbnailConsumerCommand;

    /**
     * @var string
     */
    public static $videothumbnailConsumerCommand;

    /**
     * @var string
     */
    public static $indesignthumbnailConsumerCommand;

    /**
     * @var string
     */
    public static $allowedUploadFormats = ".jpeg,.jpg,.png,.gif,.eps,.tiff,.tif,.psd,.indd,.mp4,.mov,.pdf,.divx,.mkv,.wmv,.3gp,.m4v";
    /**
     * Config constructor.
     */
    public function __construct()
    {
        self::$weburl = config('app')['mediaconverter.public.web.url'];

        self::$websocketUrl= config('app')['mediaconverter.public.websocket.url'];

        /**
         * Queues
         */
        self::$imageThumbnailQueue = config('app')['mediaconverter.queue.imagine.thumbnails'];

        self::$videoThumbnailQueue = config('app')['mediaconverter.queue.ffmpeg.thumbnails'];

        self::$indesignThumbnailQueue = config('app')['mediaconverter.queue.indesign.thumbnails'];

        /**
         * Commands
         */
        self::$imagethumbnailConsumerCommand = config('app')['mediaconverter.queue.imagine.consumercommand'];

        self::$videothumbnailConsumerCommand = config('app')['mediaconverter.queue.ffmpeg.consumercommand'];

        self::$indesignthumbnailConsumerCommand = config('app')['mediaconverter.queue.indesign.consumercommand'];
    }
}