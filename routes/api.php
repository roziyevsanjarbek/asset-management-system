<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceAssignmentController;
use App\Http\Controllers\DeviceCheckController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceDetailController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/device-types', DeviceTypeController::class);

    Route::resource('/employees', EmployeeController::class);

    Route::resource('/devices', DeviceController::class);

    Route::resource('/device-details', DeviceDetailController::class);

    Route::resource('/device-assignments', DeviceAssignmentController::class);

    Route::post('/check-device/{employeeId}/device/{inventoryNumber}', [DeviceCheckController::class, 'checkDevice']);
});
