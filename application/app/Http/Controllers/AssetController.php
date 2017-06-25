<?php

namespace App\Http\Controllers;

use App\Helper\Asset\Cropper\Image;
use App\Helper\Asset\Cropper\Model;
use App\Helper\Asset\Import\Upload;
use App\Helper\Asset\Import\UploadFormConfig;
use App\Helper\Asset\Url;
use App\Models\Asset;
use App\Models\AssetsCroppings;
use App\Models\User;
use App\Repository\Emotico\Client;
use App\Repository\Emotico\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use TCG\Voyager\Facades\Voyager;

/**
 * Class AssetController
 * @package App\Http\Controllers
 */
class AssetController extends \TCG\Voyager\Http\Controllers\VoyagerBreadController
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('browse_'.$dataType->name);

        $getter = $dataType->server_side ? 'paginate' : 'get';

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            $relationships = $this->getRelationships($dataType);

            if ($model->timestamps) {
                $dataTypeContent = call_user_func([$model->with($relationships)->latest(), $getter]);
            } else {
                $dataTypeContent = call_user_func([
                    $model->with($relationships)->orderBy($model->getKeyName(), 'DESC'),
                    $getter,
                ]);
            }

            //Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        $view = "bread.assets.browse";

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('read_'.$dataType->name);

        $relationships = $this->getRelationships($dataType);
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $dataTypeContent = call_user_func([$model->with($relationships), 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        //Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'bread.assets.read';

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function downloadHighres(Request $request)
    {
        $url = Url::getDownloadHighresUrl($request->get('file'));

        return redirect()->away($url);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function import()
    {
        $uploadFormConfig = (new UploadFormConfig())->toJson();

        return view('bread.assets.import', compact('uploadFormConfig'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);


        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        Voyager::canOrFail('edit_'.$dataType->name);

        $relationships = $this->getRelationships($dataType);
        /** @var  $dataTypeContent Asset*/
        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? app($dataType->model_name)->with($relationships)->findOrFail($id)
            : DB::table($dataType->name)->where('id', $id)->first();

        $emoticoConfig = (new Config());

        $base64Image = Image::getBase64Image($dataTypeContent,'png');

        $uploadFormConfig = (new UploadFormConfig())->toJson();

        $userCroppings = $dataTypeContent->getUserCroppings(User::find(Auth::user()->id));

        return view('bread.assets.edit', compact('dataType', 'dataTypeContent', 'emoticoConfig', 'base64Image', 'uploadFormConfig', 'userCroppings'));
    }

    /**
     * @param UploadFormConfig $uploadFormConfig
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUploadFormConfig(UploadFormConfig $uploadFormConfig)
    {
        return response()->json($uploadFormConfig);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveCropping(Request $request)
    {
        try
        {
            $message = json_decode(json_encode($request->get('message')));
            if (!$message->uuid) throw new \InvalidArgumentException('message invalid');

            /**
             * Get user
             */
            $user = User::find($message->user_id);
            if (!$user->id) throw new \InvalidArgumentException('uuid' . $request->get('uuid') . ' not found');

            //have to wait till the backend event sends the cropped asset.
            sleep(2);
            /**
             * Get parent asset
             */
            $assetUuid = Model::getAssetUiidFromEventMessage($message);
            $asset = Asset::where('uuid', $assetUuid)->get()->first();

            if (!$asset) throw new \InvalidArgumentException('asset ' . $assetUuid . ' not found.');

            /**
             * CroppingAsset
             */
            $croppingAsset = Asset::where('uuid', $message->uuid)->get()->first();

            if (!$croppingAsset) throw new \InvalidArgumentException('cropping asset ' . $message->uuid . ' not found.');

            /**
             * Save cropping
             */
            $canvasData = json_encode($message->canvasdata);
            $croppingData = [
                'asset_id' => $asset->id,
                'cropping_asset_id' => $croppingAsset->id,
                'user_id' => $user->id,
                'canvasdata'=> $canvasData,
                'cropping_hash'=> md5($user->id.$croppingAsset->id.$asset->id)
            ];

            $assetCropping = new AssetsCroppings($croppingData);

            if(!$assetCropping->doesExists())
            {
                $assetCropping->save();
            }


        }catch(\Exception $ex)
        {
            $response = new Response();

            $response->setContent($ex->getMessage().$ex->getTraceAsString());

            $response->setStatusCode(500);

            return $response;
        }

        return response()->json($assetCropping->attributesToArray());
    }

    /**
     * @param Request $request
     * @return array
     */
    public function storeBase64Image(Request $request)
    {
        try
        {
            $base64Image = $request->get('base64Image');

            $filename = $request->get('filename');

            $emoticoService = new Upload();

            $emoticoService->storeBase64Image($filename, $base64Image);
        }
        catch(\Exception $ex)
        {
            return['error'=>$ex->getMessage().$ex->getTraceAsString()];
        }

        return ['success'];
    }

    /**
     * @param int $id
     * @return array
     */
    public function deleteCropping(int $id)
    {
        /** @var  $crop AssetsCroppings */
        $crop = AssetsCroppings::find($id);

        ($crop) ? $crop->delete() : null;

        return ['success'];
    }
}