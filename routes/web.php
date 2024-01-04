<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BotiqueController;
use App\Http\Controllers\LogController;

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

Route::get('/', [AuthController::class, 'loginForm' ])->name('login');
Route::get('/register', [AuthController::class, 'registerForm' ]);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login');


     Route::get('/botiques', [BotiqueController::class, 'index'])->middleware('auth.dashboard', 'guest')->name('botiques.index');
     Route::get('/botiques/create', [BotiqueController::class, 'create'])->name('botiques.create');
     Route::post('/botiques', [BotiqueController::class, 'store'])->name('botiques.store');
     Route::get('/botiques/{botique}', [BotiqueController::class, 'show'])->name('botiques.show');
     Route::get('/botiques/{botique}/edit', [BotiqueController::class, 'edit'])->name('botiques.edit');
     Route::put('/botiques/{botique}', [BotiqueController::class, 'update'])->name('botiques.update');
     Route::delete('/botiques/{botique}', [BotiqueController::class, 'destroy'])->name('botiques.destroy');
     Route::get('/botique-logs', [LogController::class, 'index'])->middleware('auth.dashboard', 'guest')->name('botique-logs');



Route::get('verification/{user}/{token}', [AuthController::class, 'verification']);






