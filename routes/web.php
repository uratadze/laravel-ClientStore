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

// Main store dashboard
Route::get('/', 'StoreController@index')->name('store');

// Get products from DB
Route::get('/store/product/picture/{id}', 'StoreController@getPicture')->name('product.picture');

// Define Auth routes
Auth::routes(['verify' => true]);

// LoggedIn users routes
Route::middleware(['auth', 'verified'])->group(function()
{
    // Get order dashboard routes
    Route::get('/order', 'OrderController@index')
        ->name('shop.order');
    
    // Get dashboard routes group
    Route::group(['prefix' => 'dashboard'], function () 
    {
        // Get person info dashboard route
        Route::get('/', 'HomeController@index')
            ->name('home'); 

        // Get person info update route
        Route::post('/person-info', 'HomeController@changePersonInfo')
            ->name('change.person');

        // Get person account info update route
        Route::post('/account-info', 'HomeController@changeAccountInfo')
            ->name('change.account');

        // Get person account password update route
        Route::post('/password-change', 'HomeController@changePassword')
            ->name('change.password');

    });

    // Get cart routes group
    Route::group(['prefix' => 'cart'], function () 
    {
        // Get cart dashboard route
        Route::get('/', 'ShopCartController@index')
            ->name('shop.cart');

        // Get cart item remove route
        Route::get('/remove/{id}', 'ShopCartController@removeCart')
            ->name('shop.cart.remove');

        // Get cart item update and checkout route
        Route::post('/submit', 'ShopCartController@submitCart')
            ->name('shop.cart.submit');

        // Get cart checkout route
        Route::get('/checkout', 'CheckoutController@index')
            ->name('shop.cart.checkout');

        // Get personal info insert form route
        Route::get('/checkout/person-info', 'CheckoutController@personInfo')
            ->name('person.info');

        // Get personal info store route
        Route::post('/checkout/person-info', 'CheckoutController@storePersonInfo')
            ->name('person.info.store');

        // Get product add into shop cart route
        Route::get('/add', 'ShopCartController@add')
            ->name('shop.cart.add');
    });
});

