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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['namespace' => 'User', 'middleware' => [ 'auth', 'role:user']], function (){
    Route::get('/prize', 'PrizeController@game')->name('user.game');
    Route::post('/prize/get', 'PrizeController@getPrize')->name('user.prize.get');
    Route::post('/prize/refuse', 'PrizeController@refusePrize')->name('user.prize.refuse');
    Route::post('/prize/convert', 'PrizeController@convertMoneyPrize')->name('user.prize.convert');
    Route::get('/account', 'AccountController@accaunt')->name('user.account');
    Route::post('/account/balance', 'AccountController@curentBalance')->name('user.account.balance');
    Route::post('/account/withdraw', 'AccountController@withdraw')->name('user.account.withdraw');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function (){
    Route::get('/manage', 'ManageController@dashboard')->name('admin.manage');
});

Route::get('/home', 'HomeController@index')->name('home');
