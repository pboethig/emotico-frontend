<?php

namespace App\Helper\Asset;
use App\Models\Asset;


/**
 * Class Stock
 * @package App
 */
class Url
{
    /**
     * Returns pagename from url
     * @param string $url
     * @return string
     */
    public static function getStoragePathByUrl(string $url)
    {
        $storageUrl = (string)config('app')['mediaconverter.public.storage.url'];

        $path = str_replace($storageUrl . "/","", $url);

        return $path;
    }

    /**
     * @param string $url
     * @return string
     */
    public static function getDownloadHighresUrl(string $url)
    {
        $path = base64_encode(self::getStoragePathByUrl($url));

        return config('app')['mediaconverter.public.web.url'] . '/assets/' . $path . '/downloadHighres';
    }

    /**
     * @param Asset $asset
     * @return string
     */
    public static function getDownloadUrlByDataType(Asset $asset)
    {
        $path = base64_encode("/assets/" . $asset->uuid . "/" . $asset->version . "." . $asset->extension);

        $storagePath =  "assets/" . $path . "/downloadHighres";

        $storagePath = config('app')['mediaconverter.public.web.url'] . "/" .$storagePath;

        return $storagePath;
    }
}