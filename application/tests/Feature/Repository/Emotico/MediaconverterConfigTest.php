<?php

namespace Tests\Feature\Repository\Emotico;

use App\Repository\Emotico\Config;
use App\Repository\Emotico\MediaconverterConfig;
use Tests\Feature\FeatureTestAbstract;

/**
 * Class BreadTest
 * @package Tests\Feature\Asset
 */
class MediaconverterConfigTest extends FeatureTestAbstract
{
    public function setUp()
    {
        parent::setUp();
    }


    public function testGetAll()
    {
        $mediaconverterRepository = new MediaconverterConfig(new Config());

        $config = $mediaconverterRepository->all();

        $this->assertNotEmpty($config);
    }

    public function testByKeys()
    {
        $mediaconverterRepository = new MediaconverterConfig(new Config());

        $config = $mediaconverterRepository->getByKey('converters');

        $this->assertNotEmpty($config);
    }

    public function testFormatsGroupedByConverters()
    {
        $mediaconverterRepository = new MediaconverterConfig(new Config());

        $config = $mediaconverterRepository->getFormatsGroupedByConverter();

        $this->assertNotEmpty($config['ffmpeg']);

        $this->assertNotEmpty($config['imagine']);

        $this->assertNotEmpty($config['indesign']);
    }

    public function testGetAllSupportedFormatsAsString()
    {
        $mediaconverterRepository = new MediaconverterConfig(new Config());

        $config = $mediaconverterRepository->getAllSupportedFormatsAsString();

        $this->assertNotEmpty($config);
    }
}
