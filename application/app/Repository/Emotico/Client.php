<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 16.06.17
 * Time: 14:33
 */

namespace App\Repository\Emotico;
use App\Helper\Asset\Cropper\HiresCroppingRequest;


/**
 * Class Client
 * @package App\Repository\Emotico
 */
class Client
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;
    /**
     * Config constructor.
     * @param Config $config
     */
    public function __construct(\App\Repository\Emotico\Config $config)
    {
        $this->config = $config;

        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @param string $path
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(string $path)
    {
        $response = null;

        try
        {
            $response = $this->client->get(Config::$weburl.$path);

        }catch (\Exception $ex)
        {
            $message = "Backendsystem emotico has problems: Message:". $ex->getMessage().$ex->getTraceAsString();

            die($message);
        }

        return $response;
    }

    /**
     * @param string $path
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post(string $path, array $parameter)
    {
        return $this->client->request("POST", Config::$weburl.$path, $parameter);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function startWebsocket()
    {
        return $this->get('/websocket/start');
    }

    /**
     * @param \App\Models\AssetsCroppings $cropping
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function generateHiresCropping(\App\Models\AssetsCroppings $cropping)
    {
        $payload = new HiresCroppingRequest($cropping);
        
        $response = $this->post('/assets/generateHiresCropping', ['body'=>$payload->toJson()]);

        return $response;
    }
}