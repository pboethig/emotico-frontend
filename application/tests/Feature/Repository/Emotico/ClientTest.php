<?php

namespace Tests\Feature\Repository\Emotico;

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

    public function testGenerateHiresCropping()
    {
        $client = new Client(new Config());
        
        $client->generateHiresCropping();
    }
}
