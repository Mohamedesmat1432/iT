<?php

use App\Http\Controllers\Pages\AdminController;
use App\Http\Controllers\Pages\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
        });
    });

Route::middleware(['auth:sanctum', 'role.admin', config('jetstream.auth_session'), 'verified'])
    ->group(function () {

        Route::controller(AdminController::class)->group(function () {
            Route::get('/admin-dashboard', 'dashboard')->name('admin-dashboard');
            Route::get('/users', 'users')->name('users');
            Route::get('/departments', 'departments')->name('departments');
            Route::get('/companies', 'companies')->name('companies');
            Route::get('/licenses', 'licenses')->name('licenses');
        });
    });
