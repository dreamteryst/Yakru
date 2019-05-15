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
Route::post('paypal', 'PaymentController@payWithpaypal');
Route::get('status', 'PaymentController@getPaymentStatus')->name('status');
Route::get('photo/{file_path}', 'PhotoController@index')->where('file_path', '.+');
Route::group(['middleware' => ['web']], function () {
// Login Routes...
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::post('admin/login', ['as' => 'login.post', 'uses' => 'Auth\AdminLoginController@login']);
    Route::get('logout', function () {
        Auth::logout();
        return redirect('/auth');
    });

// Registration Routes...
    Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);

// Password Reset Routes...
    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);
});

Route::prefix('api')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/user', function (Request $request) {
            return Auth::user();
        });
        Route::get('chat/{id}', 'ChatController@jsonData')->name('chat.data');
        Route::post('chat', 'ChatController@store')->name('course.store');
        Route::post('course/refund', 'RefundController@store');
        Route::post('course/buy', 'CourseController@buy')->name('course.buy');
        Route::get('course/me', 'CourseController@myCourse')->name('coures.me');
        Route::get('course/teacherCourse', 'CourseController@teacherCourse')->name('coures.teacherCourse');
        Route::get('course/user/{id}', 'CourseController@courseUser')->name('coures.courseUser');
        Route::post('payment', 'PaymentController@store')->name('payment.store');
        Route::post('teacher/register', 'TeacherRegisterController@store')->name('teacherRegister.store');
        Route::post('user/update', 'Admin\UserController@update');
        Route::post('user/password', 'Admin\UserController@password');
        Route::get('course/notify/{id}', 'CourseController@notify');
        Route::get('example/course/{id}', 'Admin\ExampleController@course');
    });
    Route::get('bank', 'BankController@jsonData')->name('bank.data');
    Route::get('category', 'CategoryController@jsonData')->name('category.data');
    Route::get('course/new', 'CourseController@new')->name('course.new');
    Route::get('course/{id}', 'CourseController@show')->name('course.show');
    Route::get('course/like/{id}', 'CourseController@like')->name('course.like');

    Route::get('example/{id}', 'Admin\ExampleController@show');
    Route::post('example/done', 'UserExampleController@store');
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
    Route::get('logout', function () {
        Auth::logout();
        return redirect('/admin/auth');
    });
    Route::get('/user', function (Request $request) {
        return Auth::user();
    });

    Route::prefix('api')->group(function () {
        Route::get('category/data', 'Admin\CategoryController@anyData');
        Route::resource('category', 'Admin\CategoryController');

        Route::get('course/data', 'Admin\CourseController@anyData');
        Route::get('course/{id}/unit', 'Admin\CourseController@unit');
        Route::resource('course', 'Admin\CourseController');

        Route::get('unit/data/{id}', 'Admin\UnitController@anyData');
        Route::post('unit/upload', 'Admin\UnitController@upload');
        Route::resource('unit', 'Admin\UnitController');

        Route::get('example/data/{id}', 'Admin\ExampleController@anyData');
        Route::get('example/course/{id}', 'Admin\ExampleController@jsonData');
        Route::resource('example', 'Admin\ExampleController');


        Route::get('lecture/data/{id}', 'Admin\LectureController@anyData');
        Route::resource('lecture', 'Admin\LectureController');

        Route::get('order/data', 'Admin\OrderController@anyData');
        Route::resource('order', 'Admin\OrderController');

        Route::get('payment/data', 'Admin\PaymentController@anyData');
        Route::post('payment/confirm/{mode}', 'Admin\PaymentController@confirm');
        Route::resource('payment', 'Admin\PaymentController');

        Route::get('promotion/data', 'Admin\PromotionController@anyData');
        Route::resource('promotion', 'Admin\PromotionController');

        Route::get('schedule/data/{id}', 'Admin\ScheduleController@anyData');
        Route::resource('schedule', 'Admin\ScheduleController');

        Route::get('topup/data', 'Admin\TopupController@anyData');
        Route::resource('topup', 'Admin\TopupController');

        Route::get('student/data', 'Admin\StudentController@anyData');
        Route::resource('student', 'Admin\StudentController');

        Route::get('teacher/data', 'Admin\AdminController@anyData');
        Route::get('teacherRegister/data', 'TeacherRegisterController@anyData');
        Route::post('teacherRegister/confirm/{mode}', 'TeacherRegisterController@confirm');

        Route::get('setting/stats', 'Admin\SettingController@stats');
        Route::get('refund', 'RefundController@anyData');
        Route::post('refund/confirm/{id}', 'RefundController@confirm');
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
