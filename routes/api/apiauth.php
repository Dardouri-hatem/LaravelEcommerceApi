<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthPassportController;
use App\Http\Controllers\ProductController;
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

Route::post('register',[AuthPassportController::class,'register']);
Route::post('login',[AuthPassportController::class,'login']);
Route::get('users',[AuthPassportController::class,'users']);
Route::delete('deleteUser',[AuthPassportController::class,'delete']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('userInfo',[AuthPassportController::class,'userInfo']);
});

