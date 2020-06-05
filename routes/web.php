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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/home', 'User\ProductController@index')->name('home');
Route::get('/product', 'User\ProductController@getAllProduct')->name('list-product');
Route::get('/preview/{id}', 'User\ProductController@show')->name('preview');

// Route::get('/preview', 'User\ProductController');

Route::get('/text', function(){
	return view('admin.cate.list');
});
// ADMIN


Route::group(['prefix'=>'admin'],function (){


});
