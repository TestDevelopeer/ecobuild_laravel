<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CreativeController;
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
	Route::get('/profile/{type?}', [ProfileController::class, 'index'])->name('profile');
	Route::get('/contact', [ContactController::class, 'index'])->name('contact');
	Route::post('/answer/delete', [AnswerController::class, 'destroy']);
	Route::post('/reward', [RewardController::class, 'reward']);
	Route::post('/reward/{test}/certificate', [RewardController::class, 'certificate'])->name('reward.certificate');
	Route::post('/reward/{test}/diplom', [RewardController::class, 'diplom'])->name('reward.diplom');
	Route::post('/reward/{test}/coords', [RewardController::class, 'getCenterCoords']);
	Route::post('/creative', [CreativeController::class, 'creative']);
	Route::post('/creative/process', [CreativeController::class, 'process']);
	Route::post('/creative/{creative}/upload', [CreativeController::class, 'upload'])->name('creative.upload');
	Route::post('/creative/archive', [CreativeController::class, 'downloadArchive'])->name('creative.archive');
	Route::post('/creative/comment', [CreativeController::class, 'comment'])->name('creative.comment');

	Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
	Route::post('/feedbacks/read', [FeedbackController::class, 'read'])->name('feedbacks.read');
});

Route::get('/clear-production', function () {
	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('view:clear');
	Artisan::call('route:clear');

	Artisan::call('config:cache');
	Artisan::call('route:cache');
	return "Кэш очищен и обновлен.";
});
Route::get('/clear-local', function () {
	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('view:clear');
	Artisan::call('route:clear');
	return "Кэш очищен.";
});

require __DIR__ . '/../auth.php';
