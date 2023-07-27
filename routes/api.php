<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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
Route::post('/users',[UserController::class,'create']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->get('/logout',[AuthController::class,'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->get('/users',[UserController::class,'index']);
Route::middleware('auth:sanctum')->get('/users/{id}',[UserController::class,'show']);
Route::middleware('auth:sanctum')->put('/users/{id}',[UserController::class,'update']);
Route::middleware('auth:sanctum')->delete('/users/{id}',[UserController::class,'delete']);

Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{id}',[PostController::class,'show']);
Route::middleware('auth:sanctum')->post('/posts',[PostController::class,'create']);
Route::middleware(['auth:sanctum','verify.author'])->put('/posts/{id}',[PostController::class,'update']);
Route::middleware(['auth:sanctum','verify.author'])->delete('/posts/{id}',[PostController::class,'delete']);


