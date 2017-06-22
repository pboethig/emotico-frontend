<?php

namespace Tests\Functional\Repository\Asset;

use App\Models\Asset;
use Tests\TestCase;

/**
 * Class CompanyTest
 * @package Tests\Unit
 */
class AssetTest extends TestCase
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var \App\Repository\Asset
     */
    private $assetRepository;

    public function setUp()
    {
        parent::setUp();

        $assetData = [
            'uuid'=> 'test123',
            'version'=>"testasset",
            'extension'=>".jpg",
            'type'=>'image',
            'thumbnailList'=>json_encode(['thumb1.jpg','thumb2.jpg'])
        ];

        $this->asset = new Asset($assetData);

        $this->asset->save();

        $this->assetRepository = new \App\Repository\Asset();
    }


    public function testSave()
    {
        $assetData = [
            'uuid'=> 'test123',
            'version'=>"testasset2",
            'extension'=>".png",
            'type'=>'image',
            'thumbnailList'=>json_encode(['thumb1.jpg','thumb2.jpg','thumb3.jpg'])
        ];

        $newAsset = new Asset($assetData);

        $this->asset = $this->assetRepository->save($newAsset);

        $this->assertEquals($newAsset->version, $this->asset->version);
        $this->assertEquals($newAsset->extension, $this->asset->extension);
        $this->assertEquals($newAsset->type, $this->asset->type);
        $this->assertEquals($newAsset->thumbnailList, $this->asset->thumbnailList);
    }

    public function tearDown()
    {
        $this->asset->delete();

        parent::tearDown();
    }
}
