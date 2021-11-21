<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\CustomersController;

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
Route::get('/',[PagesController::class,'index']);

Route::resource('/invoice',InvoicesController::class);


//Route::resource('/customer',CustomersController::class);
Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', [CustomersController::class, 'index']);
        Route::get('/new', [CustomersController::class, 'create']);
        Route::get('/', [CustomersController::class, 'store']);
        Route::get('/{id}', [CustomersController::class, 'edit']);
        Route::get('/{id}', [CustomersController::class, 'update']);
        Route::get('/{id}', [CustomersController::class, 'destroy']);
    });

    Route::group(['prefix' => 'invoice'], function() {
        Route::get('/',[InvoicesController::class,'index'])->name('invoice.index');
        Route::get('/new',[InvoicesController::class,'create'])->name('invoice.create');
        Route::post('/', [InvoicesController::class,'store'])->name('invoice.store');
        Route::get('/{id}', [InvoicesController::class,'edit'])->name('invoice.edit');
        Route::put('/{id}', [InvoicesController::class,'update'])->name('invoice.update');
        Route::delete('/{id}/delete', [InvoicesController::class,'destroy'])->name('invoice.destroy');
        Route::get('/{id}/print', [InvoicesController::class,'generateInvoice'])->name('invoice.print');
    });
});


Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

