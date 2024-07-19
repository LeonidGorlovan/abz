<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\UserController;
use App\Services\TinifyService;
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

Route::post('/tinify', function () {
    return (new TinifyService())->test();
});

Route::get('token', [AuthController::class, 'getToken']);
Route::get('positions', PositionController::class);

Route::get('/users', [UserController::class, 'all']);
Route::get('/users/{id}', [UserController::class, 'one']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/users', [UserController::class, 'register']);
});

