<?php
/**
 * Emoticoroutes
 * Assets
 */
Route::get('/admin/assets/downloadHighres', 'AssetController@downloadHighres');
Route::get('/admin/assets/getUploadFormConfig', 'AssetController@getUploadFormConfig');
Auth::routes();
Route::get('/admin/assets/import', 'AssetController@import');
Route::post('/admin/assets/saveCropping', 'AssetController@saveCropping');
Route::post('/admin/assets/storeBase64Image', 'AssetController@storeBase64Image');
Route::get('/admin/asset/{id}/deleteCropping', 'AssetController@deleteCropping');

/**
 * Queue
 */
Route::get('/admin/queue/imagethumbnails/info', 'QueueController@getImageThumbnailQueue');
Route::get('/admin/queue/videothumbnails/info', 'QueueController@getVideoThumbnailQueue');
Route::get('/admin/queue/indesignthumbnails/info', 'QueueController@getIndesignThumbnailQueue');
Route::get('/admin/queue/{command}/startConsumer', 'QueueController@startConsumer');

/**
 * Websocket
 *
 */
Route::get('/admin/websocket/start', 'WebsocketController@start');

/**
 * Voyager routes
 */
Route::get('/', function ()
{
    header("location: admin");
    exit;
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('/home', 'HomeController@index')->name('home');
Route::post('/webhooks/thumbnailFinedataCreated', 'WebHookController@thumbnailFinedataCreated');
