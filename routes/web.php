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

Route::get('/', function () {
    return view('home');
});


//Route::get('/prize', function () {
//    return view('user.prize');
//})->name('user.prize');
//
//Route::get('/prize/get', function () {
//    return view('user.prize');
//})->name('user.prize.get');

Route::group(['namespace' => 'User', 'middleware' => [ 'auth', 'role:user']], function (){
    Route::get('/prize', 'PrizeController@game')->name('user.game');
    Route::post('/prize/get', 'PrizeController@getPrize')->name('user.prize.get');
    Route::post('/prize/refuse', 'PrizeController@refusePrize')->name('user.prize.refuse');
    Route::post('/prize/convert', 'PrizeController@convertMoneyPrize')->name('user.prize.convert');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:admin']], function (){
    Route::get('/manage', 'ManageController@dashboard')->name('admin.manage');
//    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
//    Route::resource('/category', 'CategoryController', ['as' => 'admin']);
//    Route::resource('/article', 'ArticleController', ['as' => 'admin']);
//    Route::group(['prefix' => 'user_managment', 'namespace' => 'UserManagment'], function (){
//        Route::resource('/user', 'UserController', ['as' => 'admin.user_managment']);
//    });
});

Route::get('/home', 'HomeController@index')->name('home');
