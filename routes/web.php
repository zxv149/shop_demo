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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->get('admin', function () {
    return view('backend.layouts.admin_template');
})->name("backend");

Route::get('admin/login', 'Backend\AdminLoginController@showLoginForm')
    ->name('admin.login');

Route::post('admin/login', 'Backend\AdminLoginController@login')->name('admin.login.post');

Route::prefix('admin')->group(function() {

    Route::get('logout', 'Backend\AdminLoginController@logout')->name('admin.logout');

    Route::get('/', 'Backend\AdminController@index')->name('admin.backend');

    Route::resource('member', 'Backend\MemberController', ['except' => ['show']]);

    Route::resource('product', 'Backend\ProductController', ['except' => ['show']]);

    Route::resource('order', 'Backend\OrderController', ['except' => ['show']]);

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
