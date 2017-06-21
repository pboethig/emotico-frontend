<?php

namespace Tests\Unit;

use App\Company;
use App\Helper\Asset\Import\Dropzone\Config;
use App\Helper\Asset\Import\UploadFormConfig;
use App\Helper\Asset\Thumbnail;
use App\Stock;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class CompanyTest
 * @package Tests\Unit
 */
class ConfigTest extends TestCase
{
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }


    public function testDropzoneConfig()
    {
        $dropzoneconfig = new Config();

        $this->assertNotEmpty($dropzoneconfig->dictDefaultMessage);
        $this->assertNotEmpty($dropzoneconfig->headers);
        $this->assertNotNull($dropzoneconfig->addRemoveLinks);
        $this->assertNotEmpty($dropzoneconfig->acceptedFiles);
        $this->assertNotEmpty($dropzoneconfig->autoProcessQueue);
        $this->assertNotEmpty($dropzoneconfig->maxFiles);
        $this->assertNotEmpty($dropzoneconfig->maxFilesize);
        $this->assertNotEmpty($dropzoneconfig->parallelUploads);
        $this->assertNotEmpty($dropzoneconfig->paramName);
        $this->assertNotEmpty($dropzoneconfig->previewTemplate);
        $this->assertNotEmpty($dropzoneconfig->uploadMultiple);
        $this->assertNotEmpty($dropzoneconfig->acceptedFiles);
        $this->assertNotEmpty($dropzoneconfig->url);


        $uploadFormConfig = new UploadFormConfig();

        $this->assertNotEmpty($uploadFormConfig->dropzoneConfig);
    }
}
