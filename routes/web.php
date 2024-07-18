<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;

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
	Route::get('/dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('/profile/{type?}', [ProfileController::class, 'index'])->name('profile');

	Route::post('/feedback', [FeedbackController::class, 'create'])->name('feedback');
	Route::post('/feedback/check', [FeedbackController::class, 'check']);

	Route::get('/contact', [ContactController::class, 'index'])->name('contact');
});

require __DIR__ . '/auth.php';
