<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;

Route::middleware('auth')->group(function () {
	Route::controller(FeedbackController::class)->group(function () {
		Route::post('/feedback', 'create')->name('feedback.create');
		Route::post('/feedback/check', 'check')->name('feedback.check');
	});
});
