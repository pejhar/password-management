<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Vault\PasswordController;
use App\Http\Controllers\Vault\PasswordTypeController;
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

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'handle'])->name('login');
Route::get('/', function () { return view('layouts.login'); } );
Route::post('/', function () { return view('layouts.login'); } );
Route::get('/logout', ['middleware' => ['session'], LogoutController::class, 'handle'])->name('logout');

Route::middleware(['session.auth'])->prefix('/password')->group(function () {
    Route::get('/', [PasswordController::class, 'list'])->name('list_password');
    Route::post('/', [PasswordController::class, 'create'])->name('password_create');
    Route::get('/{password_id}', [PasswordController::class, 'showPassword'])->name('show_password');
    Route::post('/{password_id}', [PasswordController::class, 'update'])->name('password_update');
    Route::delete('/{password_id}', [PasswordController::class, 'delete'])->name('password_delete');
});

Route::middleware(['session.auth'])->prefix('/password_type')->group(function () {
    Route::get('/', [PasswordTypeController::class, 'list'])->name('list_type_password');
    Route::post('/', [PasswordTypeController::class, 'create'])->name('password_type_create');
    Route::delete('/{type_id}', [PasswordTypeController::class, 'delete'])->name('password_type_delete');
});