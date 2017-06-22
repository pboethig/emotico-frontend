<?php

namespace Tests\Feature\Asset;

use Tests\Feature\FeatureTestAbstract;

/**
 * Class BreadTest
 * @package Tests\Feature\Asset
 */
class AssetControllerTest extends FeatureTestAbstract
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testGetDropzoneConfig()
    {
        $response = $this->actingAs($this->user)->get('/admin/assets/getUploadFormConfig');

        $response->assertStatus(200);
    }
}
