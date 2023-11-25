<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
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
Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, "authenticate"]);
Route::post('/logout', [AuthController::class, "logout"]);

Route::group(['middleware' => 'can:isAdmin'], function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/user', [UserController::class, 'store'])->name('postUser');
    Route::put('/user', [UserController::class, 'update'])->name('putUser');
    Route::delete('/user', [UserController::class, 'delete'])->name('deleteUser');
    
    Route::get('/team', [TeamController::class, 'index']);
    Route::post('/team', [TeamController::class, 'store'])->name('postTeam');
    Route::put('/team', [TeamController::class, 'update'])->name('putTeam');
    Route::delete('/team', [TeamController::class, 'delete'])->name('deleteTeam');    
});

Route::group(['middleware' => 'can:isParticipant'], function () {
    Route::get('/team-user', [TeamController::class, 'index_user']);
});

Route::group(['middleware' => 'can:authenticated'], function () {
    Route::get('/team/{id}', [TeamController::class, 'show']);
});
