<?php

namespace Tests\Feature\Asset;

use App\Helper\Asset\Url;
use App\Models\Asset;
use Tests\Feature\FeatureTestAbstract;

/**
 * Class BreadTest
 * @package Tests\Feature\Asset
 */
class AssetControllerTest extends FeatureTestAbstract
{
    private $asset;

    public function setUp()
    {
        parent::setUp();

        $this->asset = Asset::all()->first();
    }

    public function testDownloadHighres()
    {
        $asset = Asset::all()->first();

        $url = Url::getDownloadUrlByDataType($asset);

        $client = new \GuzzleHttp\Client();

        $response = $client->get($url);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
