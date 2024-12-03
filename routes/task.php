<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::controller(TaskController::class)->prefix('tasks')->group(function ($router) {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/', 'store')->middleware('auth:sanctum');
    Route::post('/changeStatus/{id}', 'changeStatus')->middleware('auth:sanctum');
    Route::put('/{id}', 'update')->middleware('auth:sanctum');
    Route::delete('/{id}', 'destroy')->middleware('auth:sanctum');
});
