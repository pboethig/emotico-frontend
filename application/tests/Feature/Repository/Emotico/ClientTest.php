<?php

namespace Tests\Feature\Repository\Emotico;

use App\Models\Asset;
use App\Models\AssetsCroppings;
use App\Repository\Emotico\Client;
use App\Repository\Emotico\Config;
use Tests\Feature\FeatureTestAbstract;

/**
 * Class BreadTest
 * @package Tests\Feature\Asset
 */
class ClientTest extends FeatureTestAbstract
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ClientException
     * @expectedExceptionMessageRegExp /atestfile.jpg not found/
     */
    public function testGenerateHiresCropping()
    {
        $client = new Client(new Config());

        $asset = new Asset(['uuid'=>'uuid', 'version'=>'atestfile','thumbnailList'=>'{}', 'extension'=>'jpg']);

        $asset->save();

        $croppingData = [
            'id'=>1,
            'asset_id'=>$asset->id,
            'user_id'=>1,
            'canvasdata'=>'{"width":"123","height":"123","left":"123","top":"123"}',
            'cropping_asset_id'=>$asset->id,
            'cropping_hash'=>'ahash',
            'browserimagedata'=>'{}'
        ];

        $assetCropping = new AssetsCroppings($croppingData);

        $client->generateHiresCropping($assetCropping);

        $asset->delete();
    }
}
