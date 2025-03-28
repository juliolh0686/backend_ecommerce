<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//CRUD API REST USUARIOS
Route::post('/users', [UserController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    //CRUD Persona
    Route::apiResource('role', RoleController::class);
    Route::apiResource('persona', PersonaController::class);
    Route::apiResource('permiso', PermisoController::class);
    Route::apiResource('documento', DocumentoController::class);
});

//Auth
Route::prefix('/v1/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
