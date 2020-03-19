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
//前台管理
Route::get('/', 'FrontController@index');

Route::get('/news', 'FrontController@news'); //List Page
Route::get('/news/{id}', 'FrontController@news_detail'); //Content Page

Route::get('/products', 'FrontController@products'); //List Page
Route::get('/products/{productId}', 'FrontController@products_detail'); //Content Page

Route::get('/contacts', 'FrontController@contacts'); //Contact Us

// Route::get('/add_cart/{id}', 'FrontController@add_cart'); //Cart 結帳
// Route::get('/cart_total', 'FrontController@cart_total'); //Cart 結帳
// Route::get('/cart', 'FrontController@cart'); //Cart 結帳

//
Route::get('/test_products_detail','FrontController@test_products_detail'); //cart 總覽
Route::post('/add_cart/{product_id}','FrontController@add_cart'); //cart 加入購物車
Route::post('/update_cart/{product_id}','FrontController@update_cart'); //cart 更新購物車數量
Route::post('/delete_cart/{product_id}','FrontController@delete_cart'); //cart 刪除商品於購物車中
Route::get('/cart','FrontController@cart_total'); //cart 總覽

Route::get('/cart_checkout','FrontController@cart_checkout'); //cart 結帳
Route::post('/cart_checkout','FrontController@post_cart_checkout'); //cart 結帳
//
Route::get('/contactUs', 'FrontController@contactUs'); //聯絡我們
Route::post('/contactUs/store', 'FrontController@contactUs_store'); //儲存使用者資料

Auth::routes();

//首頁

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

    //產品管理
    Route::get('products', 'ProductsController@index');

    Route::get('products/create', 'ProductsController@create');
    Route::post('products/store', 'ProductsController@store');

    Route::get('products/edit/{id}', 'ProductsController@edit');
    Route::post('products/update/{id}', 'ProductsController@update');

    Route::post('products/delete/{id}', 'ProductsController@delete');


    //產品類別管理
    Route::get('productType', 'ProductTypeController@index');

    Route::get('productType/create', 'ProductTypeController@create');
    Route::post('productType/store', 'ProductTypeController@store');

    Route::get('productType/edit/{id}', 'ProductTypeController@edit');
    Route::post('productType/update/{id}', 'ProductTypeController@update');

    Route::post('productType/delete/{id}', 'ProductTypeController@delete');


});





