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

Route::middleware(['auth'])->prefix('api')->group(function () {
    Route::get('/user', function (Request $request) {
        return Auth::user();
    });
    Route::get('/bank', 'BankController@jsonData')->name('bank.data');
    Route::get('/category', 'CategoryController@jsonData')->name('category.data');
    Route::get('/course/new', 'CourseController@new')->name('course.new');
    Route::post('/course/buy', 'CourseController@buy')->name('course.buy');
    Route::get('/course/me', 'CourseController@myCourse')->name('coures.me');
    Route::get('/course/user/{id}', 'CourseController@courseUser')->name('coures.courseUser');
    Route::get('/course/{id}', 'CourseController@show')->name('course.show');
    Route::get('/course/like/{id}', 'CourseController@like')->name('course.like');
    Route::post('/payment', 'PaymentController@store')->name('payment.store');
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
        Route::get('category/data', 'Admin\CategoryController@anyData');
        Route::resource('category', 'Admin\CategoryController');

        Route::get('course/data', 'Admin\CourseController@anyData');
        Route::resource('course', 'Admin\CourseController');

        Route::get('unit/data/{id}', 'Admin\UnitController@anyData');
        Route::resource('unit', 'Admin\UnitController');

        Route::get('lecture/data/{id}', 'Admin\LectureController@anyData');
        Route::resource('lecture', 'Admin\LectureController');

        Route::get('order/data', 'Admin\OrderController@anyData');
        Route::resource('order', 'Admin\OrderController');

        Route::get('payment/data', 'Admin\PaymentController@anyData');
        Route::post('payment/confirm', 'Admin\PaymentController@confirm');
        Route::resource('payment', 'Admin\PaymentController');

        Route::get('promotion/data', 'Admin\PromotionController@anyData');
        Route::resource('promotion', 'Admin\PromotionController');

        Route::get('schedule/data/{id}', 'Admin\ScheduleController@anyData');
        Route::resource('schedule', 'Admin\ScheduleController');

        Route::get('student/data', 'Admin\StudentController@anyData');
        Route::resource('student', 'Admin\StudentController');

        Route::get('teacher/data', 'Admin\AdminController@anyData');
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
