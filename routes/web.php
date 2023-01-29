<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QueueController;
use App\Http\Controllers\Admin\UnitCodeController;
use App\Http\Controllers\Authentication\LogOutController;
use App\Http\Controllers\Authentication\ShowController;
use App\Http\Controllers\Authentication\VerifyController;
use App\Http\Controllers\BarcodeController;
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

Route::get('/', function () {
    return view('public.index');
})->name('index');

Route::group(['prefix' => '/barcode'], function () {
    Route::get('/generate', [BarcodeController::class, 'index'])->name('barcode.show_form');
    Route::get('/bank', [BarcodeController::class, 'bank'])->name('barcode.get_bank');
    Route::post('/bank', [BarcodeController::class, 'generateBarcode'])->name('barcode.post_form');
    Route::get('/show/{queue}', [BarcodeController::class, 'showBarcode'])->name('barcode.show');
});

Route::group(['prefix' => 'auth', 'middleware' => ['isLogin']], function () {
    Route::get('/show', [ShowController::class, 'index'])->name('auth.show');
    Route::post('/verify', [VerifyController::class, 'call'])->name('auth.verify');
});

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');

    Route::resource('/banks', BankController::class);
    Route::resource('/unit_codes', UnitCodeController::class);
    Route::resource('/queue_logs', QueueController::class);
    Route::get('/over_sla', [\App\Http\Controllers\Admin\OverSlaController::class, 'index'])->name('admin.over_sla');
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('admin.reports');
    Route::get('/log_out', [LogOutController::class, 'call'])->name('auth.log_out');
});
