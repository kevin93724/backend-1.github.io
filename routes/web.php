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
Route::get('/', 'FrontController@index');

Route::get('/news', 'FrontController@news'); //List Page
Route::get('/news/{id}', 'FrontController@news_detail'); //Content Page


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//後台管理
Route::group(['middleware' => ['auth'], 'prefix' => '/home'], function(){

    // 首頁
    Route::get('/', 'HomeController@index');

    //最新消息管理

    Route::get('news', 'NewsController@index');

    Route::get('news/create', 'NewsController@create');
    Route::post('news/store', 'NewsController@store');

    Route::get('news/edit/{id}', 'NewsController@edit');
    Route::post('news/update/{id}', 'NewsController@update');

    Route::post('news/delete/{id}', 'NewsController@delete');

    Route::post('ajax_delete_news_imgs', 'NewsController@ajax_delete_news_imgs');
    Route::post('ajax_post_sort', 'NewsController@ajax_post_sort');

    Route::post('ajax_upload_img', 'UploadImgController@ajax_upload_img');
    Route::post('ajax_delete_img', 'UploadImgController@ajax_delete_img');

});





