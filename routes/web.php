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
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin');
    });
    Route::get('/{any}', function () {
        return view('admin');
    })->where('any', '.*');
});

Route::prefix('auth')->group(function () {
    Route::get('/', function () {
        return view('auth');
    });
    Route::get('/{any}', function () {
        return view('auth');
    })->where('any', '.*');
});

Route::get('errors', function () {
    return view('admin');
});

Route::get('/{any}', function () {
    return view('main');
})->where('any', '.*');

Route::get('/home', 'HomeController@index')->name('home');
