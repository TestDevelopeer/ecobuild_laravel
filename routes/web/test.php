<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::middleware('auth')->group(function () {
	Route::resources([
		'tests' => TestController::class,
	]);

	Route::controller(TestController::class)->group(function () {
		Route::get('/tests/{test}/completed', 'completed')->name('tests.completed');
		Route::post('/tests/reward/config', 'rewardConfig')->name('tests.reward.config');
	});
});
