<?php

use App\Models\Sales;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});


//Default Login
Route::get('/', 'App\Http\Controllers\LoginDefaultController@index')->name('default.login.Login');


//Satış Route
Route::namespace('App\Http\Controllers\Satis')->group(function () {
    Route::get('/satis/login', 'DefaultController@login')->name('default.Login');
    Route::prefix('default')->group(function () {
        Route::get('/home', 'DefaultController@index')->name('default.Index');
        Route::get('/logout', 'DefaultController@logout')->name('default.Logout');
        Route::post('/login/authenticate', 'DefaultController@authenticate')->name('default.Authenticate');
        Route::get('/get-customers-for-date', 'DefaultController@getCustomersForDate')->name('get_customers_for_date');
    });
});


Route::middleware(['admin'])->group(function () {
    Route::namespace('App\Http\Controllers\Satis')->group(function () {
        Route::prefix('customer')->group(function () {
            Route::get('/home', 'CustomerController@index')->name('customer.Index');
            Route::get('/create', 'CustomerController@create')->name('customer.Create');
            Route::get('/all', 'CustomerController@tumu')->name('customer.All');
            Route::get('/new', 'CustomerController@new')->name('customer.New');
            Route::get('/acceptance', 'CustomerController@acceptance')->name('customer.Acceptance');
            Route::get('/rejection', 'CustomerController@rejection')->name('customer.Rejection');
            Route::get('/appointment', 'CustomerController@appointment')->name('customer.Appointment');
            Route::post('/create/post', 'CustomerController@store')->name('customer.Store');
            Route::get('/edit/{id}', 'CustomerController@edit')->name('customer.Edit');
            Route::post('/add-product/{id}', 'CustomerController@addProduct')->name('customer.add_product');
            Route::post('/update/{id}', 'CustomerController@update')->name('customer.Update');
            Route::get('/delete/{id}', 'CustomerController@destroy')->name('customer.Delete');
            Route::post('/customer/store', 'CustomerController@stor')->name('customer.Stor');
            Route::post('/customer/{id}', 'CustomerController@sales')->name('customer.Sales');
            Route::get('/getTodayAppointments', 'CustomerController@getTodayAppointments');
            Route::get('/customer/ımport', 'CustomerController@import')->name('customer.Import');
            Route::post('/customer/import/store', 'CustomerController@importStore')->name('customer.import.Store');
            Route::post('/not_post', 'CustomerController@callExplanation')->name('not.Post');
            Route::post('/customer/condition/{id}', 'CustomerController@condition')->name('customer.Condition');
        });
    });
});


Route::middleware(['admin'])->group(function () {
    Route::namespace('App\Http\Controllers\Satis')->group(function () {
        Route::prefix('product')->group(function () {
            Route::get('/home', 'ProductController@index')->name('product.Index');
            Route::get('/create', 'ProductController@create')->name('product.Create');
            Route::post('/create/post', 'ProductController@store')->name('product.Store');
            Route::get('/edit/{id}', 'ProductController@edit')->name('product.Edit');
            Route::post('/update/{id}', 'ProductController@update')->name('product.Update');
            Route::get('/delete/{id}', 'ProductController@destroy')->name('product.Delete');
        });
    });
});


Route::middleware(['admin'])->group(function () {
    Route::namespace('App\Http\Controllers\Satis')->group(function () {
        Route::prefix('sales')->group(function () {
            Route::get('/home', 'SalesController@index')->name('sales.Index');
            Route::get('/delete/{id}', 'SalesController@destroy')->name('sales.Delete');
        });
    });
});


Route::middleware(['admin'])->group(function () {
    Route::namespace('App\Http\Controllers\Satis')->group(function () {
        Route::prefix('cancel')->group(function () {
            Route::get('/home', 'CancelController@index')->name('cancel.Index');
            Route::get('/delete/{id}', 'CancelController@destroy')->name('cancel.Delete');
        });
    });
});


Route::middleware(['admin'])->group(function () {
    Route::namespace('App\Http\Controllers\Satis')->group(function () {
        Route::prefix('meet')->group(function () {
            Route::get('/home', 'MeetController@index')->name('meet.Index');
            Route::post('home-post', 'MeetController@date')->name('meet.Post');
            Route::get('/delete/{id}', 'MeetController@destroy')->name('meet.Delete');
        });
    });
});


Route::middleware(['admin'])->group(function () {
    Route::namespace('App\Http\Controllers\Satis')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/home', 'UserController@index')->name('user.Index');
            Route::get('/create', 'UserController@create')->name('user.Create');
            Route::post('/store', 'UserController@store')->name('user.Store');
            Route::get('/edit/{id}', 'UserController@edit')->name('user.Edit');
            Route::post('/update/{id}', 'UserController@update')->name('user.Update');
            Route::get('/delete/{id}', 'UserController@destroy')->name('user.Delete');
        });
    });
});


Route::middleware(['admin'])->group(function () {
    Route::namespace('App\Http\Controllers\Satis')->group(function () {
        Route::prefix('authorization')->group(function () {
            Route::get('/home', 'AuthorizationController@index')->name('authorization.Index');
            Route::get('/edit/{id}', 'AuthorizationController@edit')->name('authorization.Edit');
            Route::post('/update/{id}', 'AuthorizationController@update')->name('authorization.Update');
        });
    });
});


Route::get('/calculate-earnings/{id}', function ($id) {
    $sales = Sales::find($id);
    $earnings = $sales->calculateEarnings();

    return view('sales.calculate', ['earnings' => $earnings]);
});

Route::get('/download-excel', 'App\Http\Controllers\ExcelController@downloadExcel')->name('excel.Download');
Route::get('/download-excel/table', 'App\Http\Controllers\ExcelController@downloadExcelTable')->name('excel.Table');




//Onarım Route
Route::namespace('App\Http\Controllers\Onarim')->group(function () {
    Route::get('/onarim/login', 'DefaultController@login')->name('onarim.default.Login');
    Route::prefix('onarim/default')->group(function () {
        Route::get('/home', 'DefaultController@index')->name('onarim.default.Index');
        Route::get('/logout', 'DefaultController@logout')->name('onarim.default.Logout');
        Route::post('/login/authenticate', 'DefaultController@authenticate')->name('onarim.default.Authenticate');
    });
});


Route::middleware(['admin'])->group(function () {
    Route::namespace('App\Http\Controllers\Onarim')->group(function () {
        Route::prefix('onarim/user')->group(function () {
            Route::get('/home', 'UserController@index')->name('onarim.user.Index');
            Route::get('/create', 'UserController@create')->name('onarim.user.Create');
            Route::post('/store', 'UserController@store')->name('onarim.user.Store');
            Route::get('/edit/{id}', 'UserController@edit')->name('onarim.user.Edit');
            Route::post('/update/{id}', 'UserController@update')->name('onarim.user.Update');
            Route::get('/delete/{id}', 'UserController@destroy')->name('onarim.user.Delete');
        });
    });
});


Route::middleware(['admin'])->group(function () {
    Route::namespace('App\Http\Controllers\Onarim')->group(function () {
        Route::prefix('onarim/repair')->group(function () {
            Route::get('/home', 'RepairCustomerController@index')->name('onarim.repair.Index');
            Route::get('/create', 'RepairCustomerController@create')->name('onarim.repair.Create');
            Route::post('/store', 'RepairCustomerController@store')->name('onarim.repair.Store');
            Route::get('/edit/{id}', 'RepairCustomerController@edit')->name('onarim.repair.Edit');
            Route::post('/update/{id}', 'RepairCustomerController@update')->name('onarim.repair.Update');
            Route::get('/delete/{id}', 'RepairCustomerController@destroy')->name('onarim.repair.Delete');
            Route::post('/not-post', 'RepairCustomerController@call')->name('onarim.not.Post');
        });
    });
});


Route::middleware(['admin'])->group(function () {
    Route::namespace('App\Http\Controllers\Onarim')->group(function () {
        Route::prefix('onarim/today')->group(function () {
            Route::get('/home', 'TodayController@index')->name('onarim.today.Index');
        });
    });
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
