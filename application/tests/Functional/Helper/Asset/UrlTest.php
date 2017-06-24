<?php

namespace Tests\Unit;

use App\Company;
use App\Helper\Asset\Thumbnail;
use App\Helper\Asset\Url;
use App\Models\Asset;
use App\Stock;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class CompanyTest
 * @package Tests\Unit
 */
class UrlTest extends TestCase
{
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }


    public function testGetStoragePathByUrl()
    {
        $url = "http://172.17.0.1:8181/export/293665700abaaf23d2345c1b1ddd3fad/document.exportjpg_91.jpg";

        $path = Url::getStoragePathByUrl($url);

        $this->assertFalse(strpos($path, '://') >-1);

        $this->assertNotEmpty($path);
    }

    public function testGetDownloadHighresUrl()
    {
        $url = "http://172.17.0.1:8181/export/293665700abaaf23d2345c1b1ddd3fad/document.exportjpg_91.jpg";

        $url = Url::getDownloadHighresUrl($url);

        $this->assertNotEmpty($url);
    }

    public function testGetDownloadHighresUrlByDataType()
    {
        $asset = Asset::all()->first();

        $url = Url::getDownloadHighresUrl($asset);

        $this->assertNotEmpty($url);
    }

    public function testGetStoragePath()
    {
        $asset= new Asset(['uuid'=>'auuid','version'=>'aversion','extension'=>'jpg']);

        $path = Url::getStoragePath($asset);

        $this->assertEquals('assets/auuid/aversion.jpg', $path);
    }

    public function testGetHighresUrl()
    {
        $asset= new Asset(['uuid'=>'auuid','version'=>'aversion','extension'=>'jpg']);

        $url = Url::getHighresUrl($asset);

        $this->assertNotEmpty($url);
    }
}
