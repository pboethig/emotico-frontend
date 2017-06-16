<?php

namespace Tests\Feature\Repository\Emotico;

use App\Repository\Emotico\Config;
use App\Repository\Emotico\Queue;
use Tests\Feature\FeatureTestAbstract;

/**
 * Class BreadTest
 * @package Tests\Feature\Asset
 */
class QueueTest extends FeatureTestAbstract
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testGetQueueInfos()
    {
        $queue = new Queue(new Config());

        $infos = $queue->getQueue(Config::$imageThumbnailQueue);

        $this->assertNotEmpty($infos);

        $this->assertNotNull($infos->messages);
    }

    public function testImageThumbnails()
    {
        $response = $this->actingAs($this->user)->get('admin/queue/imagethumbnails/info');

        $response->assertStatus(200);
    }

    public function testStartConsumer()
    {
        $response = $this->actingAs($this->user)->get('admin/queue/'.Config::$imagethumbnailComsumerCommand.'/startConsumer');

        $response->assertStatus(200);
    }
}
