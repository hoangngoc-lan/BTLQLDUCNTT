<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\bakery\HomeController;
use App\Http\Controllers\bakery\DetailsController;
use App\Http\Controllers\cart\cart_controller;
use App\Http\Controllers\account\LoginController;
use App\Http\Controllers\search\search_controller;
use App\Http\Controllers\admin\admin_controller;

Route::get('logout' , [LoginController::class , 'logout'])->name('logout');
	// User Account
Route::get('signin' , [LoginController::class , 'signin'])->name('login');
Route::get('signup' , [LoginController::class , 'signup'])->name('signup');
Route::post('create_user' , [LoginController::class , 'create_user'])->name('create_user');
Route::post('auth_user', [LoginController::class, 'auth_user'])->name('auth_user');
	// Admin Account
Route::get('admin_signin' , [LoginController::class , 'admin_signin'])->name('admin_login');
//Route::get('admin_signup' , [LoginController::class , 'admin_signup'])->name('admin_signup');
//Route::post('create_admin' , [LoginController::class , 'create_admin'])->name('create_admin');
Route::post('auth_admin', [LoginController::class, 'auth_admin'])->name('auth_admin');

Route::group(['prefix'=>'user' , 'middleware'=>'check_user_account'] , function () {
	Route::get('/settings',[HomeController::class,'user_settings'])->name('user_settings');
	Route::put('/update_image',[HomeController::class,'user_update_image'])->name('user_update_image');
	Route::put('/update_details',[HomeController::class,'user_update_details'])->name('user_update_details');
});

Route::group(['prefix'=>'cart' , 'middleware'=>'check_user_account'] , function () {
	Route::get('/',[cart_controller::class,'cart'])->name('cart');
	Route::post('/update/{id}',[cart_controller::class,'cart_update'])->name('cart_update');
	Route::get('/delete/{id}',[cart_controller::class,'cart_delete'])->name('cart_delete');
	Route::get('/delete_all',[cart_controller::class,'cart_delete_all'])->name('cart_delete_all');
	Route::post('/order',[cart_controller::class,'cart_order'])->name('user_orders');
});
Route::get('details/{id}', [DetailsController::class, 'details'])->name('book_details');
Route::post('details/comment/{id}', [DetailsController::class, 'create_comment'])->name('details_create_comment')->middleware('check_user_account');
Route::post('add_cart/{id}', [DetailsController::class, 'add_cart'])->name('add_cart')->middleware('check_user_account');
Route::post('order_now/{id}', [DetailsController::class, 'order_now'])->name('order_now')->middleware('check_user_account');


Route::get('{return?}' , [search_controller::class , 'search_view'])->name('home');
Route::prefix('home')->group(function () {
	Route::get('/{return?}' , [search_controller::class , 'search_view'])->name('search_view');
	Route::post('store' , [search_controller::class , 'search_store'])->name('search_store');
});

Route::group(['prefix'=>'admin' , 'middleware'=>'check_admin_account'] , function () {
	Route::get('/settings' , [ admin_controller::class , 'admin_account_settings' ])
		->name('admin_account_settings');
	Route::put('/update_image',[admin_controller::class,'admin_account_update_image'])
		->name('admin_account_update_image');
	Route::put('/update_details',[admin_controller::class,'admin_account_update_details'])
		->name('admin_account_update_details');
	Route::get('/admin_comment_lists',[admin_controller::class,'admin_comment_lists'])
		->name('admin_comment_lists');

	Route::group(['prefix'=>'admins' , 'middleware'=>['check_admin_account' , 'check_admin_level']] , function () {

		Route::get('/' , [ admin_controller::class , 'admin_admin_lists' ])
			->name('admin_admin_lists');
		Route::get('/index' , [ admin_controller::class , 'admin_admin_lists' ])
			->name('admin_admin_lists');
		Route::get('/add' , [ admin_controller::class , 'admin_admin_add' ])
			->name('admin_admin_add');
		Route::post('/store' , [ admin_controller::class , 'admin_admin_store' ])
			->name('admin_admin_store');
		Route::get('/delete/{id}' , [ admin_controller::class , 'admin_admin_delete' ])
			->name('admin_admin_delete');

	});
	Route::prefix('users')->group(function () {

		Route::get('/' , [ admin_controller::class , 'admin_user_lists' ])
			->name('admin_user_lists');
		Route::get('/index' , [ admin_controller::class , 'admin_user_lists' ])
			->name('admin_user_lists');
		Route::get('/delete/{id}' , [ admin_controller::class , 'admin_user_delete' ])
			->name('admin_user_delete');
		Route::get('/comments/{id}' , [ admin_controller::class , 'admin_user_comment' ])
			->name('admin_user_comment');

	});
	Route::prefix('bookstores')->group(function () {

		Route::get('/' , [ admin_controller::class , 'admin_bookstore_lists' ])
			->name('admin_bookstore_lists');
		Route::get('/index' , [ admin_controller::class , 'admin_bookstore_lists' ])
			->name('admin_bookstore_lists');
		Route::get('/add' , [ admin_controller::class , 'admin_bookstore_add' ])
			->name('admin_bookstore_add');
		Route::post('/store' , [ admin_controller::class , 'admin_bookstore_store' ])
			->name('admin_bookstore_store');
		Route::get('/edit/{id}' , [ admin_controller::class , 'admin_bookstore_edit' ])
			->name('admin_bookstore_edit');
		Route::put('/update/{id}' , [ admin_controller::class , 'admin_bookstore_update' ])
			->name('admin_bookstore_update');
		Route::get('/delete/{id}' , [ admin_controller::class , 'admin_bookstore_delete' ])
			->name('admin_bookstore_delete');

	});
	Route::prefix('books')->group(function () {

		Route::get('/' , [ admin_controller::class , 'admin_book_lists' ])
			->name('admin_book_lists');
		Route::get('/index' , [ admin_controller::class , 'admin_book_lists' ])
			->name('admin_book_lists');
		Route::get('/add' , [ admin_controller::class , 'admin_book_add' ])
			->name('admin_book_add');
		Route::post('/store' , [ admin_controller::class , 'admin_book_store' ])
			->name('admin_book_store');
		Route::get('/edit/{id}' , [ admin_controller::class , 'admin_book_edit' ])
			->name('admin_book_edit');
		Route::put('/update/{id}' , [ admin_controller::class , 'admin_book_update' ])
			->name('admin_book_update');
		Route::get('/delete/{id}' , [ admin_controller::class , 'admin_book_delete' ])
			->name('admin_book_delete');

	});
	Route::prefix('tags')->group(function () {

		Route::get('/' , [ admin_controller::class , 'admin_tag_lists' ])
			->name('admin_tag_lists');
		Route::get('/index' , [ admin_controller::class , 'admin_tag_lists' ])
			->name('admin_tag_lists');
		Route::get('/add' , [ admin_controller::class , 'admin_tag_add' ])
			->name('admin_tag_add');
		Route::post('/store' , [ admin_controller::class , 'admin_tag_store' ])
			->name('admin_tag_store');
		Route::get('/edit/{id}' , [ admin_controller::class , 'admin_tag_edit' ])
			->name('admin_tag_edit');
		Route::put('/update/{id}' , [ admin_controller::class , 'admin_tag_update' ])
			->name('admin_tag_update');
		Route::get('/delete/{id}' , [ admin_controller::class , 'admin_tag_delete' ])
			->name('admin_tag_delete');

	});
	Route::prefix('orders')->group(function () {

		Route::get('/index/{id?}' , [ admin_controller::class , 'admin_order_lists' ])
			->name('admin_order_lists');
		Route::get('/delete/{id}' , [ admin_controller::class , 'admin_order_delete' ])
			->name('admin_order_delete');
		Route::get('/confirm/{id}' , [ admin_controller::class , 'admin_order_confirm' ])
			->name('admin_order_confirm');
		Route::get('/disconfirm/{id}' , [ admin_controller::class , 'admin_order_disconfirm' ])
			->name('admin_order_disconfirm');
		Route::get('/details/{id}' , [ admin_controller::class , 'admin_order_details' ])
			->name('admin_order_details');

	});
});