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

// Authentication
Route::group(['prefix' => 'authentication', 'namespace' => 'Auth'], function () {
    Route::get('/', 'AuthenticationController@index')->name('authentication');
    Route::post('/authenticate', 'AuthenticationController@authenticate')->name('authenticate');
    Route::get('/forgot-password', 'AuthenticationController@forgot')->name('forgot-password');
    Route::post('/recovery', 'AuthenticationController@recovery')->name('recovery');
    Route::get('/confirm', 'AuthenticationController@confirm')->name('confirm');
});

// Manager
Route::group(['prefix' => 'manager', 'namespace' => 'Manager', 'middleware' => 'employee'], function () {
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

    // Tour
    Route::group(['prefix' => 'tour'], function () {
        Route::get('/', 'TourController@index')->name('tour-list');
    });

    // Articles
    Route::group(['middleware' => 'admin', 'prefix' => 'articles'], function () {
        Route::get('/', 'ArticleController@index')->name('articles.index');
        Route::get('/create', 'ArticleController@create')->name('articles.create');
        Route::post('/', 'ArticleController@store')->name('articles.store');
        Route::get('/{id}/edit', 'ArticleController@edit')->name('articles.edit');
        Route::match(['put', 'patch'],'/{id}', 'ArticleController@update')->name('articles.update');
        Route::delete('/{id}', 'ArticleController@destroy')->name('articles.destroy');
    });

});

// Main
Route::group(['namespace' => 'Main'], function () {
    Route::group(['prefix' => 'articles'], function () {
       Route::get('/', 'ArticleController@list')->name('articles.list');
       Route::get('/{slug}', 'ArticleController@detail')->name('articles.detail');
    });
});
