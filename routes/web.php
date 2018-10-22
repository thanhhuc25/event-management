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


if(config('app.env') === 'production'){
//    URL::forceScheme('https');
}

//Route::get('/', function () {
//    return view('home');
//});

//Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::any('/search', 'HomeController@search')->name('search');

// admin login
Route::get('/admin/login', "AdminController@showLogin")->name("adminShowLogin");
Route::post('/admin/login', "AdminController@doLogin")->name("adminDoLogin");

// admin
Route::group(["prefix" => "admin", 'middleware' => 'auth'], function (){
    //Route::get('/', "AdminController@index")->name("adminIndex");
    Route::get('/', "AdminEventController@index")->name("adminIndex");
    Route::any('/profile', "AdminProfileController@index")->name("adminProfile");
    Route::get('/logout', "AdminController@logout")->name("adminLogout");
    // shop
    Route::get('/shops', "AdminShopController@index")->name("adminShops");
    // event
    Route::get('/events', "AdminEventController@index")->name("adminEventList");
    Route::any('/event/create', "AdminEventController@create")->name("adminEventCreate");
    Route::any('/event/edit/{id}', "AdminEventController@edit")->name("adminEventEdit");
    Route::any('/event/delete/{id}', "AdminEventController@delete")->name("adminEventDelete");
    Route::get('/event/{id}/medias', "AdminEventController@medias")->name("adminEventMedias");
    // account
    Route::get('/accounts', "AdminAccountController@index")->name("adminAccounts");
    Route::any('/account/create', "AdminAccountController@create")->name("adminAccountCreate");
    Route::any('/account/edit/{id}', "AdminAccountController@edit")->name("adminAccountEdit");
    Route::any('/account/delete/{id}', "AdminAccountController@delete")->name("adminAccountDelete");

    // Display view
    Route::post('datatable', 'DataTableController@datatable');
    //Route::post('datatable', 'DataTableController@datatable');
    // Get Data
    Route::post('datatable/getdata', 'DataTableController@getEvents')->name('datatable/getdata');
    //Route::post('datatable/getdata', 'DataTableController@getEvents')->name('datatable/getdata');

    // Display view
    Route::post('datatable-user', 'DataTableUsersController@datatable');
    // Get Data
    Route::post('datatable-user/getdata', 'DataTableUsersController@getUsers')->name('datatable-user/getdata');
});

