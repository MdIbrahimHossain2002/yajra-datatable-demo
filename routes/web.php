<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('users', [UserController::class, 'index']);
// Route::get('users/data', [UserController::class, 'getData'])->name('users.data');
// Route::post('users', [UserController::class, 'store'])->name('users.store');


Route::get('users', [UserController::class, 'index']);
Route::get('users/data', [UserController::class, 'getData'])->name('users.data');
Route::post('users', [UserController::class, 'store'])->name('users.store');