<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 22.06.17
 * Time: 16:16
 */

namespace App\Repository;
use App\Helper\Asset\Cropper\Model;
use App\Models\Asset;
use App\Models\User;
use App\Repository\Emotico\Client;
use App\Repository\Emotico\Config;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Asset
 * @package App\Repository
 */
class AssetsCroppings
{
    /**
     * @param Request $request
     * @return \App\Models\AssetsCroppings
     */
    public function save(Request $request, int $sleep=0)
    {
        $message = json_decode(json_encode($request->get('message')));
        if (!isset($message->uuid)) throw new \InvalidArgumentException('message invalid');

        /**
         * Get user
         */
        $user = User::find($message->user_id);
        if (!isset($user->id)) throw new \InvalidArgumentException('uuid' . $request->get('uuid') . ' not found');

        $assetUuid = $this->getAssetUuid($message, $sleep);
        $asset = Asset::where('uuid', $assetUuid)->get()->first();

        if (!$asset) throw new \InvalidArgumentException('asset ' . $assetUuid . ' not found.');

        /**
         * CroppingAsset
         */
        $croppingAsset = Asset::where('uuid', $message->uuid)->get()->first();

        if (!$croppingAsset) throw new \InvalidArgumentException('cropping asset ' . $message->uuid . ' not found.');
       /**
         * Save cropping
         */
        $canvasData = json_encode($message->canvasdata);
        $browserimagedata = json_encode($message->browserimagedata);

        $croppingData = [
            'asset_id' => $asset->id,
            'cropping_asset_id' => $croppingAsset->id,
            'user_id' => $user->id,
            'canvasdata'=> $canvasData,
            'browserimagedata'=> $browserimagedata,
            'cropping_hash'=> md5($user->id.$croppingAsset->id.$asset->id)
        ];

        $assetCropping = new \App\Models\AssetsCroppings($croppingData);

        if(!$assetCropping->doesExists())
        {
            try
            {
                $assetCropping->save();
            }
            catch (\Exception $ex)
            {

            }
        }

        /**
         * Create higres printable tiff version
         */
        $this->generateHiresCropping($assetCropping);

        return $assetCropping;
    }

    /**
     * @return string
     */
    private function getAssetUuid(\stdClass $message, int $sleep =0)
    {
        if($sleep) sleep($sleep);
        $assetUuid = Model::getAssetUiidFromEventMessage($message);

        return $assetUuid;
    }

    /**
     * @param \App\Models\AssetsCroppings $cropping
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function generateHiresCropping(\App\Models\AssetsCroppings $cropping)
    {
        $client = new Client(new Config());
        
        return $client->generateHiresCropping($cropping);
    }
}