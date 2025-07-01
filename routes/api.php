<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


    Route::get('/user', function (Request $request) {
    return $request->user();
    })->middleware('auth:sanctum');


    Route::middleware('auth:sanctum')->apiResource('tasks', TaskController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
