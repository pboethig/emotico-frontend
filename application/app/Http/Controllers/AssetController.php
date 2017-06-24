<?php

namespace App\Http\Controllers;

use App\Helper\Asset\Cropper\Image;
use App\Helper\Asset\Import\DropzoneConfig;
use App\Helper\Asset\Import\UploadFormConfig;
use App\Helper\Asset\Url;

use App\Repository\Emotico\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? app($dataType->model_name)->with($relationships)->findOrFail($id)
            : DB::table($dataType->name)->where('id', $id)->first();

        $emoticoConfig = (new Config());

        $base64Image = Image::getBase64Image($dataTypeContent,'png');

        $uploadFormConfig = (new UploadFormConfig())->toJson();

        return view('bread.assets.edit', compact('dataType', 'dataTypeContent', 'emoticoConfig', 'base64Image', 'uploadFormConfig'));
    }

    /**
     * @param UploadFormConfig $uploadFormConfig
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUploadFormConfig(UploadFormConfig $uploadFormConfig)
    {
        return response()->json($uploadFormConfig);
    }
}
