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

Route::get('/news', 'FrontController@news');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/news', 'NewsController@index');

Route::get('/home/news/create', 'NewsController@create');
Route::post('/home/news/store', 'NewsController@store');

Route::get('/home/news/edit/{id}', 'NewsController@edit');
Route::post('/home/news/update/{id}', 'NewsController@update');
Route::post('/home/news/delete', 'NewsController@delete');


