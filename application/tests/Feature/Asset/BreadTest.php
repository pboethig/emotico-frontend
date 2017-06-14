<?php

namespace Tests\Feature\Asset;

use App\Models\Asset;
use Tests\Feature\FeatureTestAbstract;

/**
 * Class BreadTest
 * @package Tests\Feature\Asset
 */
class BreadTest extends FeatureTestAbstract
{

    private $asset;

    public function setUp()
    {
        parent::setUp();

        $this->asset = Asset::all()->first();
    }


    public function testIndex()
    {
        $response = $this->actingAs($this->user)->get('/admin/assets');

        $response->assertStatus(200);

        $response->assertSee("Edit");

        $response->assertSee("Delete");

        $response->assertSee("View");

        $response->assertSee("assets");
    }

    public function testView()
    {
        $response = $this->actingAs($this->user)->get('/admin/assets/' . $this->asset->id);

        $response->assertStatus(200);

        $response->assertSee("Viewing Asset");
    }
    
    
}
