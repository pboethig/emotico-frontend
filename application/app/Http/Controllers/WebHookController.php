<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Symfony\Component\HttpFoundation\Request;
use TCG\Voyager\Http\Controllers\Controller;

class WebHookController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function thumbnailFinedataCreated(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $assetData = [
            'uuid'=>$data['message']['uuid'],
            'version'=>$data['message']['version'],
            'extension'=>$data['message']['extension'],
            'type'=>'image',
            'thumbnailList'=>json_encode($data['message']['thumbnailList'])
        ];

        $asset = new  Asset($assetData);

        try
        {
            $asset->save();

        }catch (\Exception $ex)
        {

        }

        return ['success'];
    }
    
}
