<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 22.06.17
 * Time: 16:16
 */

namespace App\Repository;

/**
 * Class Asset
 * @package App\Repository
 */
class Asset
{

    /**
     * @param \App\Models\Asset $asset
     * @return \App\Models\Asset
     */
    public function save(\App\Models\Asset $asset) : \App\Models\Asset
    {
        $persistedAsset = \App\Models\Asset::where('uuid', $asset->uuid)->get()->first();

        if($persistedAsset)
        {
            return $this->update($persistedAsset, $asset);
        }

        $asset->save();

        return $asset;
    }

    /**
     * @param \App\Models\Asset $persistedAsset
     * @param \App\Models\Asset $newAsset
     * @return \App\Models\Asset
     */
    public function update(\App\Models\Asset $persistedAsset, \App\Models\Asset $newAsset)
    {
        $persistedThumbnailList = $this->mergeThumbnailList($persistedAsset, $newAsset);

        $persistedAsset->thumbnailList = json_encode($persistedThumbnailList);

        $persistedAsset->version = $newAsset->version;

        $persistedAsset->extension = $newAsset->extension;

        $persistedAsset->save();

        return $persistedAsset;
    }

    /**
     * @param \App\Models\Asset $persistedAsset
     * @param \App\Models\Asset $newAsset
     * @return array|mixed
     */
    private function mergeThumbnailList(\App\Models\Asset $persistedAsset, \App\Models\Asset $newAsset)
    {
        $thumbnailList = json_decode($newAsset->thumbnailList, true);

        $persistedThumbnailList = json_decode($persistedAsset->thumbnailList);

        foreach ($thumbnailList as $url)
        {
            if(!in_array($url, $persistedThumbnailList))
            {
                $persistedThumbnailList[]=$url;
            }
        }

        return $persistedThumbnailList;
    }
}