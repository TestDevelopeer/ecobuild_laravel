<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::middleware('auth')->group(function () {
	Route::controller(TestController::class)->group(function () {
		Route::get('/test/create', 'create')->name('test.create');
		Route::get('/test/edit/{id}', 'edit')->name('test.edit');
		Route::get('/test/all', 'all')->name('test.all');

		Route::post('/test/add', 'add')->name('test.add');
		Route::post('/test/save', 'save')->name('test.save');
		Route::post('/test/delete', 'delete')->name('test.delete');
	});
});
