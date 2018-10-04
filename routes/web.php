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
Route::group(['middleware' => ['web']], function () {
// Login Routes...
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::post('admin/login', ['as' => 'login.post', 'uses' => 'Auth\AdminLoginController@login']);
    Route::get('logout', function () {
        Auth::logout();
        return redirect('/auth');
    });
    Route::get('admin/logout', function () {
        Auth::logout();
        return redirect('/admin/auth');
    });

// Registration Routes...
    Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);

// Password Reset Routes...
    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);
});

Route::middleware('auth')->get('/user', function (Request $request) {
    return Auth::user();
});

Route::group(['middleware' => ['guest:web_admin']], function () {
    Route::get('admin/auth', function () {
        return view('auth');
    })->name('admin.login');
});

Route::middleware(['auth:web_admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin');
    });
    Route::get('/user', function (Request $request) {
        return Auth::user();
    });

    Route::prefix('api')->group(function () {
        Route::get('category/data', 'CategoryController@anyData');
        Route::resource('category', 'CategoryController');

        Route::get('course/data', 'CourseController@anyData');
        Route::resource('course', 'CourseController');

        Route::get('unit/data/{id}', 'UnitController@anyData');
        Route::resource('unit', 'UnitController');

        Route::get('lecture/data/{id}', 'LectureController@anyData');
        Route::resource('lecture', 'LectureController');

        Route::get('order/data', 'OrderController@anyData');
        Route::resource('order', 'OrderController');
    });

    Route::get('/{any}', function () {
        return view('admin');
    })->where('any', '.*');
});

Route::group(['middleware' => ['guest']], function () {
    Route::prefix('auth')->group(function () {
        Route::get('/', function () {
            return view('auth');
        })->name('login');
        Route::get('/{any}', function () {
            return view('auth');
        })->where('any', '.*');
    });
});

Route::get('errors', function () {
    return view('admin');
});

Route::get('/{any}', function () {
    return view('main');
})->where('any', '.*');

Route::get('/home', 'HomeController@index')->name('home');
