<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

Route::middleware('auth')->group(function () {
	Route::controller(QuestionController::class)->group(function () {
		Route::post('/question/add', 'add')->name('question.add');
		Route::post('/question/save', 'save')->name('question.save');
		Route::post('/question/delete', 'delete')->name('question.delete');
		Route::post('/question/asset/delete', 'assetDelete')->name('question.asset.delete');
		Route::post('/question/asset/get', 'assetGet')->name('question.asset.get');
	});
});
