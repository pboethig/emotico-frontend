<?php

namespace Tests\Browser\Bread\Asset;

use App\Helper\Asset\Import\Upload;
use App\Helper\Asset\Url;
use App\Models\Asset;
use App\Models\User;
use App\Repository\Emotico\Config;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

/**
 * Class ImportTest
 * @package Tests\Browser\Bread\Asset
 */
class ImportTest extends DuskTestCase
{

    public function testUpload()
    {
        $files =
            [
                [
                    'name'     => 'file[]',
                    'contents' => file_get_contents("/var/www/public/images/audi.png"),
                    'filename' => 'testFile1.jpg'
                ],
                [
                    'name'     => 'file[]',
                    'contents' => file_get_contents("/var/www/public/images/images.png"),
                    'filename' => 'testFile2.jpg'
                ],
                [
                    'name'     => 'file[]',
                    'contents' => file_get_contents("/var/www/public/images/shanghai_logo.png"),
                    'filename' => 'testFile3.jpg'
                ],
                [
                    'name'     => 'file[]',
                    'contents' => file_get_contents("/var/www/public/images/logo.png"),
                    'filename' => 'testFile4.jpg'
                ],
                [
                    'name'     => 'file[]',
                    'contents' => file_get_contents("/var/www/public/images/test.mkv"),
                    'filename' => 'testFile5.mkv'
                ]
            ];

        $upload = new Upload();

        $res = $upload->upload($files);

        $this->assertEquals(200, $res->getStatusCode());


        /**
         * Trigger process
         */
        $guzzle = new \GuzzleHttp\Client();

        $config = new Config();

        foreach ($files as $file)
        {
            $res = $guzzle->get($config::$weburl . '/assets/process?file='. $file['filename']);
            $this->assertEquals(200, $res->getStatusCode());
        }

        /**
         * Run consumer
         */
        $res = $guzzle->get($config::$weburl . '/queue/mittax:mediaconverter:thumbnail:imagine:startconsumer/startConsumer');

        $this->assertEquals($res->getStatusCode(), 200);

        $this->asset = Asset::where('version','testFile1')->get()->first();

        $url = Url::getDownloadUrlByDataType($this->asset);

        $res = $guzzle->get($url);

        $this->assertEquals(200, $res->getStatusCode());
    }

    /**
     * Correct login.
     *
     * @return void
     */
    public function testOpenImportPageLogin()
    {
       $this->browse(function (Browser $browser)
        {
            $browser->loginAs(User::all()->first())
            ->visit('/admin/assets/import')
            ->waitFor('.admin-section-title')
            ->assertSee('Asset Import')
            ->assertSee('Drop your')
            ->assertSee('Files in image')
            ->assertSee('Files in video')
            ->assertSee('Files in indesign')
            ->assertSee('Connection')
            ->assertSee('Successfully connected')
            ->waitFor('#indesign_server')
            ->assertSee('InDesignServer');
        });
    }
}