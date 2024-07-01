<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
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


use App\Http\Controllers\AuthController;



Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('login.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/event-form', [EventController::class, 'showForm'])->name('event.form');
Route::get('/events', [EventController::class, 'index'])->name('events.index');

Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Route to handle form submission
Route::post('/event-form', [EventController::class, 'submitForm'])->name('event.submit');