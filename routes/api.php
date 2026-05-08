<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/device-types', [DeviceTypeController::class, 'index']);
    Route::post('/device-types', [DeviceTypeController::class, 'store']);
    Route::get('/device-types/{id}', [DeviceTypeController::class, 'show']);
    Route::put('/device-types/{id}', [DeviceTypeController::class, 'update']);
    Route::delete('/device-types/{id}', [DeviceTypeController::class, 'destroy']);
});
