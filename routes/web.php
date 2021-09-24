<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\TypeController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/', [LoginController::class, 'show'])
    ->name('login');

Route::post('/', [LoginController::class, 'handle'])
    ->name('login');

Route::get('/logout', [LogoutController::class, 'handle'])
    ->name('logout');


Route::get('types', [TypeController::class, 'index']);
Route::post('types', [TypeController::class, 'store']);
    