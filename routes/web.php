<?php

use App\Models\Article;
use App\Models\Tour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    Route::post('/recovery', 'AuthenticationController@recovery')->name('recovery');
    Route::get('/confirm', 'AuthenticationController@confirm')->name('confirm');
    Route::post('/register-guide', 'AuthenticationController@registerGuide')->name('register-guide');
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
    });

    // Tour
    Route::group(['prefix' => 'tour'], function () {
        Route::get('/', 'TourController@list')->name('tour-list');
        Route::get('/create', 'TourController@create')->name('tour-create');
        Route::post('/store', 'TourController@store')->name('tour-store');
        Route::get('/edit/{slug}', 'TourController@edit')->name('tour-edit');
        Route::post('/update', 'TourController@update')->name('tour-update');
        Route::post('/delete', 'TourController@delete')->name('tour-delete');
        Route::get('/{id}', 'TourController@detail')->name('tour-detail');

        Route::patch('/{id}/set-active', 'TourController@setActive')->name('tour-set-active');
        Route::patch('/{id}/set-publish', 'TourController@setPublish')->name('tour-set-publish');
        Route::delete('/{id}/delete', 'TourController@delete')->name('tour-delete');
    });

    // Invoices
    Route::group(['prefix' => 'invoices'], function () {
        Route::get('/', 'InvoiceController@index')->name('invoice-index');
        Route::get('/list', 'InvoiceController@list')->name('invoice-list');
        Route::get('/{sku}', 'InvoiceController@show')->name('invoice-show');
        Route::get('/schedule/{sku}', 'InvoiceController@schedule')->name('invoice-schedule');
        Route::get('/update/{sku}-{status}', 'InvoiceController@updateStatus')->name('invoice-update-status');
    });

    // Article
    Route::resource('articles', 'ArticleController')->except(['show']);


    // Middleware admin
    Route::group(['middleware' => 'admin'], function () {
        // Article category
        Route::resource('article_categories', 'ArticleCategoryController')->except(['show']);


        //Contacts
        Route::resource('contacts','ContactController');
        Route::post('/contacts/reply', 'ContactController@reply')->name('contacts.reply');
        Route::get('/update-{id}-{status}', 'ContactController@update')->name('contacts.update');

        // Guide
        Route::group(['prefix' => 'guides'], function () {
           Route::get('/', 'GuideController@list')->name('Manager.guide.list');
           Route::put('/{id}/updateStatus', 'GuideController@updateStatus')->name('Manager.guide.updateStatus');
           Route::put('/{id}/updateBehaviorScore', 'GuideController@updateBehaviorScore')->name('Manager.guide.updateBehaviorScore');
           Route::delete('/{id}', 'GuideController@remove')->name('Manager.guide.remove');
        });
    });

    // Profile
    Route::group(['prefix' => 'account'], function () {
        Route::get('/', function () {
            return redirect()->route('account.overview');
        })->name('account');
        Route::get('/user-list', 'UserController@profile')->name('user.list');
        Route::get('profile-detail/{id}', 'UserController@detailProfile')->name('user.detail');
        Route::get('overview', 'AccountController@overview')->name('account.overview');
        Route::get('personal-information', 'AccountController@personalInformation')->name('account.personal-information');
        Route::post('update', 'AccountController@updateInformation')->name('account.update');
        Route::get('account-information', 'AccountController@accountInformation')->name('account.account-information');
        Route::get('change-password', 'AccountController@changePassword')->name('account.change-password');
        Route::get('email-setting', 'AccountController@emailSetting')->name('account.email-setting');
        Route::match(['put', 'patch'], '/{id}/updateStatus', 'UserController@updateStatus')->name('Manager.user.updateStatus');
        Route::get('log-location', 'UserController@locationLogs')->name('user.location');
    });

    // Error
    Route::fallback(function () {
        return view('Manager.error.index');
    });

    Route::group(['prefix' => 'category', 'middleware' => 'admin'], function () {
        Route::get('/', 'CategoryController@list')->name('category.list');
        Route::get('create', 'CategoryController@create')->name('category.create');
        Route::post('store', 'CategoryController@store')->name('category.store');
        Route::get('{id}', 'CategoryController@edit')->name('category.edit');
        Route::post('{id}/update', 'CategoryController@update')->name('category.update');
        Route::delete('{id}/delete', 'CategoryController@delete')->name('category.delete');
    });
});

// Main
Route::group(['namespace' => 'Main'], function () {
    Route::group(['prefix' => 'tours'], function () {
        Route::get('/','TourController@index')->name('Main.tour.index');
        Route::get('/show/{slug}','TourController@show')->name('Main.tour.show');
        Route::get('/pdf/{slug}','TourController@printPdf')->name('Main.tour.pdf');
        Route::post('/tour/review','TourController@review')->name('Main.tour.review');
    });

    Route::group(['prefix' => 'articles'], function () {
       Route::get('/', 'ArticleController@list')->name('articles.list');
       Route::get('/{slug}', 'ArticleController@detail')->name('articles.detail');
       });

    Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
       Route::get('/', 'UserController@index')->name('profile');
       Route::post('update', 'UserController@editProfile')->name('profile.edit');
    });

    Route::group(['prefix' => 'contact'], function () {
       Route::get('/', 'ContactController@index')->name('contact.index');
       Route::post('/', 'ContactController@store')->name('contact.store');
    });

    Route::group(['prefix' => 'guide'], function() {
        Route::get('/{guide_id}/detail', 'GuideController@detail')->name('guide.detail');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/history', 'TourController@history')->name('Main.history');
        Route::get('/invoices/{id}/detail', 'InvoiceController@detail')->name('Main.invoice_detail');
        Route::get('/invoices/{id}/schedule', 'InvoiceController@schedule')->name('Main.invoice_schedule');
        Route::post('/invoices/{sku}/complete', 'InvoiceController@complete')->name('Main.invoice.complete');
    });

    Route::group(['prefix' => 'wishlist', 'middleware' => 'auth'], function () {
        Route::get('/', 'WishlistController@list')->name('wishlist.list');
        Route::post('/add/{item}', 'WishlistController@addItem')->name('wishlist.add');
        Route::delete('/remove/{item}', 'WishlistController@removeItem')->name('wishlist.remove');
    });

    Route::group(['prefix' => 'checkout'], function () {
        Route::get('{slug}/detail', 'CheckoutController@detail')->name('checkout.detail');
        Route::post('payment', 'CheckoutController@payment')->name('checkout.payment');
        Route::get('confirmation', 'CheckoutController@confirmation')->name('checkout.confirmation');
        Route::get('check-tour-exist/{id}/{batch}', 'CheckoutController@checkTourExist')->name('checkout.checkTourExist');
    });
    Route::group(['prefix' => 'social'], function () {
        Route::get('auth/google', 'GoogleController@redirectToGoogle')->name('social.google');
        Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback')->name('social.google.callback');
    });

    Route::get('/article_categories/{slug}', 'ArticleCategoryController@show')->name('Main.article_category.show');

    Route::get('about', 'AboutController@index')->name('about');
    Route::get('faqs', 'FaqController@index')->name('faq');

    Route::fallback(function () {
        $tour_min = Tour::query()
            ->withCount(['reviews as rating' => function ($q) {
                $q->select(DB::raw('coalesce(avg(star),0)'));
            }])->orderBy('rating', 'desc')
            ->orderBy('adult_price', 'asc')->first();

        $articles = Article::query()->inRandomOrder()->limit(4)->get();
        return view('Main.error.index', compact('tour_min', 'articles'));
    });

    Route::group(['prefix' => 'pay'], function () {
        Route::post('request/{id}', 'PayController@request')->name('pay.request');
    });
});

/**
 * API
 */
Route::group(['namespace' => 'api', 'prefix' => 'api_v1'], function () {
    Route::group(['prefix' => 'tour'], function () {
        Route::get('list', 'TourController@list');
        Route::get('{slug}', 'TourController@findBySlug');

        // Manager tour
        Route::group(['prefix' => 'manager', 'middleware' => 'guide'], function () {
            Route::get('list', 'TourController@manager');
            Route::post('store', 'TourController@store');
            Route::get('{id}/get', 'TourController@findById');
            Route::put('{id}/update', 'TourController@update');
            Route::patch('{id}/active', 'TourController@setActive');
            Route::patch('{id}/publish', 'TourController@setPublish');
            Route::delete('{id}/delete', 'TourController@delete');
            Route::get('{id}/schedules', 'TourController@schedules');
        });

        Route::get('category', 'CategoryController@list');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@list');
    });

    Route::group(['prefix' => 'invoice'], function () {
        Route::get('tours', 'InvoiceController@tours');
        Route::get('list-by-tour/{id}', 'InvoiceController@listByTour');
    });
});
