<?php

namespace Tests\Browser\Bread\Asset;

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
        $guzzle = new \GuzzleHttp\Client();

        $config = new Config();

        $fileName=['test.jpg','test2.jpg','test3.jpg','test4.jpg','test.mkv'];

        /**
         * Upload File
         */
        $res = $guzzle->request('POST', $config::$weburl.'/assets/store', [
            'multipart' => [
                [
                    'name'     => 'file[]',
                    'contents' => file_get_contents("/var/www/public/images/audi.png"),
                    'filename' => $fileName[0]
                ],
                [
                    'name'     => 'file[]',
                    'contents' => file_get_contents("/var/www/public/images/images.png"),
                    'filename' => $fileName[1]
                ],
                [
                    'name'     => 'file[]',
                    'contents' => file_get_contents("/var/www/public/images/shanghai_logo.png"),
                    'filename' => $fileName[2]
                ],
                [
                    'name'     => 'file[]',
                    'contents' => file_get_contents("/var/www/public/images/logo.png"),
                    'filename' => $fileName[3]
                ],
                [
                    'name'     => 'file[]',
                    'contents' => file_get_contents("/var/www/public/images/test.mkv"),
                    'filename' => $fileName[4]
                ]
            ],
        ]);

        $this->assertEquals(200, $res->getStatusCode());

        /**
         * Trigger process
         */
        $res = $guzzle->get($config::$weburl . '/assets/process?file=' . $fileName[0]);

        $this->assertEquals(200, $res->getStatusCode());

        foreach ($fileName as $file)
        {
            $res = $guzzle->get($config::$weburl . '/assets/process?file=' . $file);

            $this->assertEquals(200, $res->getStatusCode());
        }

        /**
         * Run consumer
         */
        $res = $guzzle->get($config::$weburl . '/queue/mittax:mediaconverter:thumbnail:imagine:startconsumer/startConsumer');

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
            ->assertSee('Media Import')
            ->assertSee('Drop files')
            ->assertSee('Files in ImageQueue')
            ->assertSee('Files in VideoQueue')
            ->assertSee('Files in InDesignQueue')
            ->assertSee('Connection')
            ->assertSee('Successfully connected')
            ->waitFor('#indesign_server')
            ->assertSee('InDesignServer');
        });
    }
}