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


Route::get('/', 'User\ProductController@index')->name('home');
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


Route::group(['prefix'=>'card'], function(){
	Route::get('/index', 'User\CartController@index')->name('cart-index');
	Route::get('/add-cart/{id}', 'User\CartController@addCart')->name('add-cart');
	Route::get('/update', 'User\CartController@getUpdateCart')->name('update-cart');
	Route::get('/delete-cart/{id}', 'User\CartController@destroy')->name('delete-cart');
	Route::get('/checkout', 'User\CheckoutController@index')->name('checkout');
	Route::post('/checkout', 'User\CheckoutController@store')->name('add-order');
});

Route::group(['prefix'=>'ajax'], function(){
	Route::post('/rating/{id}', 'User\RatingController@saveRating')->name('save-rating');
});



Route::get('/text', function(){
	return view('admin.cate.list');
});
// ADMIN

// Route::get('/admin','AdminController@index');
Route::group(['prefix'=>'admin'],function (){

// Auth::routes();

	Route::resource('dashboard','DashboardController');

	Route::get('category/search', 'CategoryController@search')->name('search-category');
	Route::get('/','CategoryController@fetch_data');
	Route::resource('category','CategoryController');
	
	// Route::get('/category/search', 'CategoryController@search')->name('search-button');
	Route::get('/','ProductController@fetch_data');
	Route::get('product/search', 'ProductController@search');
	Route::get('product/sort-remains', 'ProductController@remains');
	Route::get('product/sort-almost', 'ProductController@almost');
	Route::get('product/sort-out', 'ProductController@out');

	
	Route::resource('product','ProductController');

	Route::post('product/{id}', 'ProductController@image')->name('post.image');
	Route::resource('image','ProductsImageController');





	Route::get('/','UserController@fetch_data');
	Route::get('user/search', 'UserController@search');
	Route::resource('user','UserController');

	Route::get('/','OrderController@fetch_data');
	Route::get('order/search', 'OrderController@search');
	Route::get('order/old', 'OrderController@old');
	Route::get('order/new', 'OrderController@new');
	Route::get('order/statu', 'OrderController@status_c');
	Route::get('order/status', 'OrderController@status_d');
	Route::get('order/statuss', 'OrderController@status_h');
	Route::resource('order','OrderController');


	Route::get('/','SuggestController@fetch_data');
	Route::get('suggest/search', 'SuggestController@search')->name('search-suggest');
	Route::resource('suggest','SuggestController');



	Route::get('/','PromotionController@fetch_data');
	Route::get('promotion/ajax/{idSup}','PromotionController@ajax');
	Route::resource('promotion','PromotionController');



});







