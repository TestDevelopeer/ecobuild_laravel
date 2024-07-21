<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

Route::middleware('auth')->group(function () {
	Route::resources([
		'questions' => QuestionController::class,
	]);

	Route::controller(QuestionController::class)->group(function () {
		/*Route::post('/question/add', 'add')->name('question.add');
		Route::post('/question/save', 'save')->name('question.save');
		Route::post('/question/delete', 'delete')->name('question.delete');*/
		Route::post('/questions/assets/delete', 'deleteAssets')->name('questions.delete.assets');
		Route::post('/questions/assets/get', 'getAssets')->name('questions.get.assets');
	});
});
