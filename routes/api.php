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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');



//YPU MUST BE AUTHENTICATED//
    Route::group([
        'middleware' => 'auth:api'
    ], function() {

        Route::post('logout', 'AuthController@logout');

        Route::get('/pages/bought/{id}','PageController@bought');
        Route::get('/pages/created/{id}','PageController@created');
        Route::get('/pages/{idPagina}/contents/scarica/{id}','ContentsController@scarica');
        Route::get('/pages/{idPagina}/contents/acquista/{id}','ContentsController@acquista');
        Route::put('/pages/{idPagina}/contents/segnala/{id}','ContentsController@segnala');
        Route::put('/pages/{idPagina}/contents/vota/{id}','ContentsController@vota');
        //YOU MUST BE ADMIN//
        Route::prefix('admin')->group(function () {
            Route::post('/universities','UniversitiesController@store');
            Route::post('/universities/courses','UniversitiesController@addCourse');

            Route::post('/moderators','ModeratorsController@store');
            Route::delete('/moderators/{id}','ModeratorsController@destroy');
            Route::put('/moderators/{id}','ModeratorsController@update');

        });
    });
});

//ALL CAN CALL THIS ROUTES//
Route::prefix('users')->group(function () {
    Route::get('/bcs','UserController@bestCollaborative');
    Route::apiResource('/','UserController');
});
//ALL OPERATIONS ON PAGES//
Route::prefix('pages')->group(function () {
    Route::get('/search','PageController@search');
    Route::get('/search/sort','PageController@sort');
    Route::get('/search/advancedFilter/sort','PageController@sort');
    Route::get('/search/advancedFilter','PageController@advancedFilter');
    Route::apiResource('/','PageController');
    Route::apiResource('/{idPagina}/contents','contentsController');
});






