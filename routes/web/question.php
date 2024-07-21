<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

Route::middleware('auth')->group(function () {
	Route::resource('tests.questions', QuestionController::class)->shallow();

	Route::controller(QuestionController::class)->group(function () {
		Route::post('/questions/assets/delete', 'deleteAssets')->name('questions.delete.assets');
		Route::post('/questions/assets/get', 'getAssets')->name('questions.get.assets');
	});
});
