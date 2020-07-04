<?php

use Illuminate\Support\Facades\Route;

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

// Unauthenticated Routes

Route::get('/', function() {return view('home');})->name('home');

Route::get('/about', function () {return view('about');})->name('about');

Route::get('/faq', function () {return view('faq');})->name('faq');

Route::get('/contact', function () {return view('contact');})->name('contact');

Route::get('/privacy', function () {return view('privacy');})->name('privacy');

Route::get('/blog', function () {return view('blog');})->name('blog');

Route::get('/admin', function() { return redirect()->route('dashboard');});

// backend codes
Route::prefix('/admin')->group(function () {

    // auth routes
    Route::get('/login', ['uses' => "Auth\LoginController@index"])->name('login');

    Route::post('/login/authenticate', ['uses' => "Auth\LoginController@authenticate"])->name('login.authenticate');

    Route::get('/register', 'Auth\RegisterController@index')->name('signup');

    Route::post('/register', 'Auth\RegisterController@register')->name('register');

    Route::get('/logout', 'Auth\LogoutController@index')->name('logout');

    Route::get('/password', 'Auth\ForgotPasswordController@index')->name('password');
    Route::post('/password', 'Auth\ForgotPasswordController@update')->name('password.reset');


    Route::group(['middleware' => 'backend.auth'], function () {

        // activation
        Route::get('/activate', 'UsersController@activate')->name('activate.user');

        // dashboard, creditor, debtor
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/creditor', 'DashboardController@creditor')->name('creditor');
        Route::get('/analytics', 'DashboardController@analytics')->name('analytics');
        Route::get('/notification', 'DashboardController@notification')->name('notification');


        // customer crud
        Route::resource('customer', 'CustomerController');

        // debtor crud
        Route::resource('debtor', 'DebtorController');

        // settings create and update
        Route::get('/setting', 'SettingsController@index')->name('setting');

        // transaction crud
        Route::resource('transaction', 'TransactionController');

        // store crud
        Route::resource('store', 'StoreController');

        // assistant crud
        Route::resource('assistant', 'AssistantController');

        // broadcast crud
        Route::resource('broadcast', 'BroadcastController');

        // complaint crud
        Route::resource('complaint', 'ComplaintController');

        // user crud
        Route::resource('users', 'UsersController');

        // super admin protected routes
        Route::group(['middleware' => 'backend.super.admin'], function () {
            // Route::get('/users', 'UsersController@index')->name('users');
            // Route::get('/users/{id}', 'UsersController@show')->name('user.view');
        });
    });
});