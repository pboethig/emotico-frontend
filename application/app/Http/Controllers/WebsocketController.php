<?php

namespace App\Http\Controllers;

use App\Repository\Emotico\Client;
use App\Repository\Emotico\Config;
use TCG\Voyager\Http\Controllers\Controller;

/**
 * Class WebHookController
 * @package App\Http\Controllers
 */
class WebsocketController extends Controller
{
    /**
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function start()
    {
        try
        {
            $emoticoService = new Client(new Config());
            
            $emoticoService->startWebsocket();

        }catch (\Exception $ex)
        {
            return response($ex->getMessage().$ex->getTraceAsString(), 500);
        }

        return ['success'];
    }
}
