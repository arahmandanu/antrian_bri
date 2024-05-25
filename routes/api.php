<?php

use App\Http\Controllers\Api\SyncQueueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/sync_from_local', [SyncQueueController::class, 'syncFromLocal'])->name('api.syncfromlocal');
Route::post('/get_number_queue', [SyncQueueController::class, 'getNumberQueue'])->name('api.getNumberQueue');
Route::post('/sync_report_from_local', [SyncQueueController::class, 'syncReportFromLocal'])->name('api.getNumberQueue');
