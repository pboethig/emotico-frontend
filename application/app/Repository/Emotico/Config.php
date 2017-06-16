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
    public static $imagethumbnailComsumerCommand;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        self::$weburl = config('app')['mediaconverter.public.web.url'];

        self::$websocketUrl= config('app')['mediaconverter.public.websocket.url'];

        self::$imageThumbnailQueue = config('app')['mediaconverter.queue.imagine.thumbnails'];

        self::$imagethumbnailComsumerCommand = config('app')['mediaconverter.queue.imagine.consumercommand'];
    }
}