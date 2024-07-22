<?php

use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
	Route::resources([
		'quizzes' => QuizController::class,
	]);
});
