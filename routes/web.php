<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');

// Authentication
Route::group(['prefix' => 'authentication', 'namespace' => 'Auth'], function () {
    Route::get('/', 'AuthenticationController@index')->name('authentication');
    Route::get('/confirm', 'AuthenticationController@confirm')->name('confirm');
});

// Manager
Route::group(['prefix' => 'manager', 'namespace' => 'Manager', 'middleware' => 'manager'], function () {
    // Manager
    Route::get('/', function () {
        return redirect()->route('dashboard-analytic');
    })->name('manager');

    // Dashboard
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', function () {
            return redirect()->route('dashboard-analytic');
        })->name('dashboard');
        Route::get('/analytic', 'DashboardController@analytic')->name('dashboard-analytic');
        Route::get('/sale', 'DashboardController@sale')->name('dashboard-sale');
    });
});
