<?php

namespace Tests\Functional\Repository\Asset;

use App\Helper\Asset\Import\Dropzone\Config;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

/**
 * Class CompanyTest
 * @package Tests\Unit
 */
class AssetCroppingsTest extends TestCase
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var \App\Repository\AssetsCroppings
     */
    private $assetsCroppingsRepository;

    public function setUp()
    {
        parent::setUp();

        $assetData = [
            'uuid'=> 'croppingtest',
            'version'=>"23123123123_highres",
            'extension'=>".tiff",
            'type'=>'image',
            'thumbnailList'=>json_encode([])
        ];

        $this->asset = new Asset($assetData);

        $this->asset->save();

        $this->assetsCroppingsRepository = new \App\Repository\AssetsCroppings();
    }

    /**
     * @expectedException \GuzzleHttp\Exception\ClientException
     * @expectedExceptionMessageRegExp  /404 Not Found/

     */
    public function testGenerateHiresCropping()
    {
        $canvasData = new \stdClass();
        $canvasData->top=10;
        $canvasData->left=10;
        $canvasData->width=10;
        $canvasData->height=10;
        $canvasData->messurement='px';

        $croppingData = [
            'asset_id' => $this->asset->id,
            'cropping_asset_id' => $this->asset->id,
            'user_id' => User::all()->first()->id,
            'canvasdata'=> json_encode($canvasData),
            'cropping_hash'=> uniqid()
        ];

        $assetCropping = new \App\Models\AssetsCroppings($croppingData);

        $assetCropping->save();

        $this->assetsCroppingsRepository->generateHiresCropping($assetCropping);
    }

    public function tearDown()
    {
        $this->asset->delete();

        parent::tearDown();
    }
}
