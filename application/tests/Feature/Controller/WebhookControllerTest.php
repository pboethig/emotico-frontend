<?php

namespace Tests\Feature\Controller;

use App\Helper\Asset\Url;
use App\Models\Asset;
use Tests\Feature\FeatureTestAbstract;

/**
 * Class BreadTest
 * @package Tests\Feature\Asset
 */
class WebhookControllerTest extends FeatureTestAbstract
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testThumbnailFinedataCreated()
    {
        $assetData = [
            'message'=>
                [
                    'uuid'=> 'test123',
                    'version'=>"testasset",
                    'extension'=>".jpg",
                    'type'=>'image',
                    'thumbnailList'=>['thumb1.jpg','thumb2.jpg']
                ]
        ];

        $client = new \GuzzleHttp\Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        $response = $client->post(config('app.url').'/webhooks/thumbnailFinedataCreated', ['body' => json_encode($assetData)]);

        $this->assertEquals(200, $response->getStatusCode());

        $res = json_decode($response->getBody()->getContents());

        $this->assertGreaterThan(0, $res->success->id);

        Asset::find($res->success->id)->delete();

    }
}
