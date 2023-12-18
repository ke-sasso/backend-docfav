<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRepositoryController;

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


Route::group(['prefix' => 'v1/user'], function ($router) {
    Route::post('create', [UserRepositoryController::class, 'createUser'])->name('user.create');
    Route::put('update/{id}', [UserRepositoryController::class, 'updateUser'])->name('user.update');
    Route::delete('delete/{id}', [UserRepositoryController::class, 'deleteUser'])->name('user.delete');
    Route::get('datos/{id}', [UserRepositoryController::class, 'datosUser'])->name('user.update');
});
