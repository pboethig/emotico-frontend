<?php

namespace App\Helper\Asset;

/**
 * Class Stock
 * @package App
 */
class Thumbnail
{
    /**
     * Returns pagename from url
     * @param string $url
     * @return string
     */
    public static function getPagenameByUrl(string $url)
    {
        $parts = explode(".jpg", $url);

        $parts = explode("_", $parts[0]);

        return end($parts);
    }
}