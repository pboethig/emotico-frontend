<?php
/**
 * Created by PhpStorm.
 * User: pboethig
 * Date: 16.06.17
 * Time: 14:33
 */

namespace App\Repository\Emotico;

/**
 * Class Queue
 * @package App\Repository\Emotico
 */
class Queue extends Client
{
    /**
     * Returns queueinfos
     *
     * @param string $queueName
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getQueue(string $queueName)
    {
        $response = $this->get('/queue/' . $queueName . '/info');

        return json_decode($response->getBody()->getContents());
    }

    /**
     * @param string $queueName
     * @return mixed
     */
    public function startConsumer(string $queueName)
    {
        $response = $this->get('/queue/' . $queueName . '/startConsumer');

        return json_decode($response->getBody()->getContents());
    }
}