<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/blog', function (Request $request) {
    return $request->user();
});*/


Route::resource('/blog', BlogController::class);

Route::middleware('auth:api')->get('/news_blog', 'BlogController@newsBlog');

Route::get('/news_email_job', 'BlogController@newsJob');
