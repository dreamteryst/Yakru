<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('category/data', 'CategoryController@anyData');
Route::resource('category', 'CategoryController');

Route::get('tag/data', 'TagController@anyData');
Route::resource('tag', 'TagController');

Route::get('course/data', 'CourseController@anyData');
Route::resource('course', 'CourseController');