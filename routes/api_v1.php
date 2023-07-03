<?php

use App\Http\Controllers\API\v1\ExportController;
use App\Http\Controllers\API\v1\VehiclesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('vehicles', VehiclesController::class);
Route::get('export/vehicles', [ExportController::class, 'exportVehicles'])->name('export.vehicles');
Route::get('vehicles/get-models-by-mark-id/{mark_id}', [VehiclesController::class, 'getModelsByMarkId'])->name('vehicles.get-models-by-mark-id');
