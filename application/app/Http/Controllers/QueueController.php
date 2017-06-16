<?php

namespace App\Http\Controllers;

use App\Repository\Emotico\Config;
use App\Repository\Emotico\Queue;
use Illuminate\Http\Request;

/**
 * Class QueueController
 * @package App\Http\Controllers
 */
class QueueController extends \TCG\Voyager\Http\Controllers\VoyagerBreadController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getImageThumbnailQueue(Request $request)
    {
        $queueInfo = new Queue(new Config());
        
        return response()->json($queueInfo->getQueue(Config::$imageThumbnailQueue));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getVideoThumbnailQueue(Request $request)
    {
        $queueInfo = new Queue(new Config());

        return response()->json($queueInfo->getQueue(Config::$videoThumbnailQueue));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndesignThumbnailQueue(Request $request)
    {
        $queueInfo = new Queue(new Config());

        return response()->json($queueInfo->getQueue(Config::$indesignThumbnailQueue));
    }

    /**
     * @param string $command
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function startConsumer(string $command, Request $request)
    {
        $queueService = new Queue(new Config());

        return response()->json($queueService->startConsumer($command));
    }
}
