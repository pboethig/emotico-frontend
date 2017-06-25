<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 22.06.17
 * Time: 18:22
 */

namespace App\Helper\Asset\Import;


use App\Repository\Emotico\Config;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Upload
 * @package App\Helper\Asset\Import
 */
class Upload
{
    /**
     * @param array $files
     * @return ResponseInterface
     */
    public function upload(array $files) : ResponseInterface
    {
        $guzzle = new \GuzzleHttp\Client();

        $config = new Config();

        $res = $guzzle->request('POST', $config::$weburl.'/assets/store', ['multipart' => $files]);

        return $res;
    }

    /**
     * @param string $filename
     * @param $base64Image
     * @return ResponseInterface
     */
    public function storeBase64Image(string $filename, $base64Image) : ResponseInterface
    {
        $guzzle = new \GuzzleHttp\Client();

        $config = new Config();

        $data = ['form_params'=>['filename' => $filename, 'base64Image'=>$base64Image]];

        $res = $guzzle->request('POST', $config::$weburl.'/assets/storeBase64Image', $data);

        return $res;
    }
}