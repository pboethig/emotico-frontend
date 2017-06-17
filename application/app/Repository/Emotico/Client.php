<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 16.06.17
 * Time: 14:33
 */

namespace App\Repository\Emotico;

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
        $response = $this->client->get(Config::$weburl.$path);

        return $response;
    }
}