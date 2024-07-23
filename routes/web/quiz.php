<?php

use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
	Route::controller(QuizController::class)->group(function () {
		Route::get('/quizzes/{test}', 'index')->name('quizzes.index');
		Route::post('/quizzes/{test}', 'show')->name('quizzes.show');
		Route::patch('/quizzes/{quiz}', 'update')->name('quizzes.update');
		Route::get('/quizzes/{test}/completed', 'completed')->name('quizzes.completed');
	});
});
