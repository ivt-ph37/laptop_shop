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


Route::get('/index', function () {
    return view('user.index');
});

Route::get('/product_detail', function(){
	return view('user.product_detail');
});
Route::get('/text', function(){
	return view('admin.cate.list');
});
// ADMIN


Route::group(['prefix'=>'admin'],function (){


});