<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\Request;
use TCG\Voyager\Http\Controllers\Controller;

/**
 * Class WebHookController
 * @package App\Http\Controllers
 */
class WebHookController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function thumbnailFinedataCreated(Request $request, \App\Repository\Asset $assetRepository)
    {
        try
        {
            $data = json_decode($request->getContent(), true);

            $assetData = [
                'uuid' => $data['message']['uuid'],
                'version' => $data['message']['version'],
                'extension' => $data['message']['extension'],
                'type' => 'image',
                'thumbnailList' => json_encode([])
            ];

            $asset = new Asset($assetData);

            $asset = $assetRepository->save($asset);

        }catch (\Exception $ex)
        {
            return new \Illuminate\Http\Response($ex->getMessage().$ex->getTraceAsString(),500);
        }

        return ['success'=>['id'=>$asset->id]];
    }

    /**
     * Unused atm. feel free to use the highrescoppingdata
     *
     * @param Request $request
     * @return array
     */
    public function hiresCroppingCreated(Request $request, \App\Repository\Asset $assetRepository)
    {
        try
        {
            $data = json_decode($request->getContent(), true);

            $assetData = [
                'uuid' => $data['message']['uuid'],
                'version' => $data['message']['version'],
                'extension' => $data['message']['extension'],
                'type' => 'image',
                'hash' => $data['message']['hash']
            ];

        }catch (\Exception $ex)
        {
            return new \Illuminate\Http\Response($ex->getMessage().$ex->getTraceAsString(),500);
        }

        return ['success'];
    }
}
