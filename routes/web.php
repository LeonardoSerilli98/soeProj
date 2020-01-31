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
Auth::routes();
Route::get('/', 'FrontEndController@getMaster')->name('master');
Route::get('/auth', 'FrontEndController@getAuth')->name('auth');

Route::get('/search', 'WebPageController@search');
Route::get('/search/advancedFilter', 'WebPageController@advancedFilter');

Route::get('/mypages', 'WebPageController@getMyPages')->name('mypages');
Route::get('/mypages/{id}', 'WebPageController@getMyPage');

Route::post('/buy', 'BuyController@buy')->name('buy');

Route::resource('/page','WebPageController')->except(['create', 'edit', 'update', 'destroy']);

Route::resource('/content','WebContentController')->except(['create', 'edit', 'update', 'destroy']);







