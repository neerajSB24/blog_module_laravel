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

/*Route::middleware('auth:api')->get('/news', function (Request $request) {
    return $request->user();
});*/

Route::resource('/news', NewsController::class);
//Route::get('news/get_blog', 'NewsController@blog');
Route::get('/view_blog', 'NewsController@blog');
Route::get('/blog_list', 'NewsController@blogList');


//Route::namespace('news')->group(function() {
//    Route::get('/get_blog', [NewsController::class, 'blog']);
//});
