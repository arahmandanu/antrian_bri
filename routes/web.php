<?php

use App\Http\Controllers\Admin\BankAreaController;
use App\Http\Controllers\Admin\BankBranchesController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QueueController;
use App\Http\Controllers\Admin\UnitCodeController;
use App\Http\Controllers\Authentication\LogOutController;
use App\Http\Controllers\Authentication\ShowController;
use App\Http\Controllers\Authentication\VerifyController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ButtonActorController;
use App\Http\Controllers\ButtonBranchController;
use App\Http\Controllers\QueueController as ControllersQueueController;
use App\Models\ButtonActor;
use Illuminate\Support\Facades\Route;
use Milon\Barcode\DNS2D;

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
Route::get('/search', [ControllersQueueController::class, 'index'])->name('public.queue.index');

Route::get('/custom_barcode', function () {
    $a = new DNS2D;
    return view('public.custom_barcode', ['barcode' => $a->getBarcodeHTML(env('APP_URL'), 'QRCODE')]);
});

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

Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'haveRole']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');

    Route::resource('/banks', BankController::class);
    Route::resource('/unit_codes', UnitCodeController::class);
    Route::resource('/queue_logs', QueueController::class);

    Route::resource('/bank_area', BankAreaController::class)->names([
        'index' => 'admin.bank_area.index',
        'create' => 'admin.bank_area.create',
        'show' => 'admin.bank_area.show',
        'store' => 'admin.bank_area.store',
        'update' => 'admin.bank_area.update',
    ]);

    Route::resource('/bank_branches', BankBranchesController::class)->names([
        'index' => 'admin.bank_branches.index',
        'create' => 'admin.bank_branches.create',
        'show' => 'admin.bank_branches.show',
        'store' => 'admin.bank_branches.store',
        'update' => 'admin.bank_branches.update',
    ]);

    Route::resource('/user', \App\Http\Controllers\Admin\UserController::class);
    Route::get('/over_sla', [\App\Http\Controllers\Admin\OverSlaController::class, 'index'])->name('admin.over_sla');

    Route::get('/list_actors', [ButtonActorController::class, 'list'])->name('admin.get_actors');
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('admin.reports');

    Route::get('/log_out', [LogOutController::class, 'call'])->name('auth.log_out');

    Route::group(['prefix' => '/settings'], function () {
        Route::resource('/button', ButtonBranchController::class)->names([
            'index' => 'operator.button.index',
            'create' => 'operator.button.create',
            'show' => 'operator.button.show',
            'store' => 'operator.button.store',
            'update' => 'operator.button.update',
        ]);
        Route::resource('/button_actor', ButtonActorController::class)->names([
            'index' => 'operator.button_actor.index',
            'create' => 'operator.button_actor.create',
            'show' => 'operator.button_actor.show',
            'store' => 'operator.button_actor.store',
            'update' => 'operator.button_actor.update',
        ]);
    });
});
