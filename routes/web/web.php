<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

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
	return null;
});

Route::middleware('auth')->group(function () {
	Route::get('/profile/{type?}', [ProfileController::class, 'index'])->name('profile');
	Route::get('/contact', [ContactController::class, 'index'])->name('contact');
	Route::post('/answer/delete', [AnswerController::class, 'destroy']);
});

require __DIR__ . '/../auth.php';
