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
Route::get('/register', 'User\UserController@index')->name('register');
Route::post('/register', 'User\UserController@store');
Route::get('/login', 'User\UserController@getLogin')->name('login');
Route::post('/login', 'User\UserController@setLogin');
Route::get('/my-account/{id}', 'User\UserController@show')->name('user');
Route::get('/my-account/account-information/{id}', 'User\UserController@edit')->name('information-user');
Route::put('/my-account/account-information/{id}/account-update/', 'User\UserController@update')->name('update-user');
Route::get('logout', 'User\UserController@logOut')->name('logout');


// Route::get('/preview', 'User\ProductController');

Route::get('/text', function(){
	return view('admin.cate.list');
});
// ADMIN


Route::group(['prefix'=>'admin'],function (){


});


// Auth::routes();



