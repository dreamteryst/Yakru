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

Route::get('/category', 'CategoryController@jsonData')->name('category.data');
Route::get('/course/{id}', 'CourseController@show')->name('course.show');
Route::get('/course/like/{id}', 'CourseController@like')->name('course.like');