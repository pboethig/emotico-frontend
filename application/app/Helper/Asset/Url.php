<?php

namespace App\Helper\Asset;
use App\Models\Asset;

/**
 * Class Url
 * @package App\Helper\Asset
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
     * Returns highresurl by thumbnail
     *
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
    public static function getHighresUrl(Asset $asset, string $extension ='')
    {
        $path = base64_encode(self::getStoragePath($asset, $extension));

        return config('app')['mediaconverter.public.web.url'] . '/assets/' . $path . '/downloadHighres';
    }

    /**
     * @param Asset $asset
     * @param string $extension
     * @return string
     */
    public static function getStoragePath(Asset $asset, string $extension ='')
    {
        if(empty($extension)) $extension = $asset->extension;

        return 'assets/' . $asset->uuid . '/' . $asset->version . '.' . $extension;
    }

    /**
     * @param Asset $asset
     * @return string
     */
    public static function getDownloadUrlByDataType(Asset $asset)
    {
        return self::getHighresUrl($asset);
    }
}