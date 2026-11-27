<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostManagementController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

// Routes that require a valid token (Authorization: Bearer <token>)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/recipe/ingredient', [PostManagementController::class, 'ingredient']);
    Route::post('/recipe/upload', [PostManagementController::class, 'upload']);
    Route::delete('/recipe/delete', [PostManagementController::class, 'delete']);

    
});
