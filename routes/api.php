<?php

use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\UsersController;
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

Route::post('/login', [UsersController::class, 'login'])->name('connexion.login');
Route::post('/registers', [UsersController::class, 'register'])->name('connexion.register');

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user',[UsersController::class, 'index']);
    Route::post('/rendezvous',[RendezVousController::class,'store']);
    Route::get('/appointments',[RendezVousController::class,'index']);
});
