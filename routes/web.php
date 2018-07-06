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

Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('product/{id}', 'Frontend\ProductController@show')->name('product.show');

Route::get('cart', 'Frontend\CartController@index')->name('cart');
Route::post('cart/add/{id}', 'Frontend\CartController@addToCart')->name('cart.add');
Route::post('cart/update', 'Frontend\CartController@updateCart')->name('cart.update');
Route::delete('cart/delete/{id}', 'Frontend\CartController@deleteCart')->name('cart.delete');

Route::post('check', 'Frontend\CartController@check')->name('cart.check');
Route::post('checkout', 'Frontend\CartController@checkout')->name('cart.checkout');

Route::get('admin/login', 'Backend\AdminLoginController@showLoginForm')
    ->name('admin.login');

Route::post('admin/login', 'Backend\AdminLoginController@login')->name('admin.login.post');

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function() {

    Route::get('logout', 'Backend\AdminLoginController@logout')->name('logout');

    Route::get('/', 'Backend\AdminController@index')->name('backend');

    Route::resource('user', 'Backend\UserController', ['except' => ['show']]);

    Route::resource('product', 'Backend\ProductController', ['except' => ['show']]);

    Route::resource('order', 'Backend\OrderController', ['except' => ['show']]);

});

Auth::routes();

