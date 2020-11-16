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
Route::group(['prefix' => 'manager', 'namespace' => 'Manager', 'middleware' => 'guide'], function () {
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
        Route::get('/user_profile', 'DashboardController@profile')->name('user_profile');
        Route::get('profile-detail/{id}', 'DashboardController@detailProfile')->name('profile-detail');
    });

    // Tour
    Route::group(['prefix' => 'tour'], function () {
        Route::get('/', 'TourController@index')->name('tour-list');
        Route::get('/create', 'TourController@create')->name('tour-create');
        Route::post('/store', 'TourController@store')->name('tour-store');
        Route::get('/{id}/edit', 'TourController@edit')->name('tour-edit');
        Route::post('/update', 'TourController@update')->name('tour-update');
        Route::post('/delete', 'TourController@delete')->name('tour-delete');
        Route::get('/{id}', 'TourController@detail')->name('tour-detail');

        Route::put('set-active', 'TourController@setActive')->name('tour-set-active');
        Route::put('set-publish', 'TourController@setPublish')->name('tour-set-publish');
        Route::delete('/{id}/delete', 'TourController@delete')->name('tour-delete');
    });

    // INvoices
    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/', 'InvoiceController@index')->name('invoice-index');
    });


    Route::group(['middleware' => 'admin'], function () {
        Route::resource('articles', 'ArticleController')->except(['show']);
        Route::resource('article_categories', 'ArticleCategoryController')->except(['show']);
        //Contact
        Route::resource('contacts','ContactController');
        Route::post('/contacts/reply', 'ContactController@reply')->name('contacts.reply');
        Route::get('/update-{id}-{status}', 'ContactController@update')->name('contacts.update');
    });

});

// Main
Route::group(['namespace' => 'Main'], function () {
    Route::group(['prefix' => 'news'], function () {
       Route::get('/', 'ArticleController@list')->name('articles.list');
       Route::get('/{slug}', 'ArticleController@detail')->name('articles.detail');
       });

    Route::group(['prefix' => 'main'], function () {
       Route::get('profile', 'ClientController@index');
       Route::post('edit-profile/{id}', 'ClientController@editProfile')->name('edit-profile');
    });

    Route::group(['prefix' => 'contact'], function () {
       Route::get('/', 'ContactController@index')->name('contact.index');
       Route::post('/', 'ContactController@store')->name('contact.store');
    });
});
