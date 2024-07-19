<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('user.all');
Route::get('/view/{id}', [UserController::class, 'view'])->name('user.view');
Route::get('/create', [UserController::class, 'create'])->name('user.create');
Route::post('/save', [UserController::class, 'save'])->name('user.save');


