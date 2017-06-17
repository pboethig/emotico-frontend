<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$namespacePrefix = '\\'.config('voyager.controllers.namespace').'\\';

/**
 * Emoticoroutes
 */

/**
 * Assets
 */
Route::get('/admin/assets/downloadHighres', 'AssetController@downloadHighres');

Auth::routes();

Route::get('/admin/assets/import', 'AssetController@import');

/**
 * Queue
 */
Route::get('/admin/queue/imagethumbnails/info', 'QueueController@getImageThumbnailQueue');
Route::get('/admin/queue/videothumbnails/info', 'QueueController@getVideoThumbnailQueue');
Route::get('/admin/queue/indesignthumbnails/info', 'QueueController@getIndesignThumbnailQueue');
Route::get('/admin/queue/{command}/startConsumer', 'QueueController@startConsumer');

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
