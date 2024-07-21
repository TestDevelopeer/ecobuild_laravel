<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::middleware('auth')->group(function () {
	Route::resources([
		'tests' => TestController::class,
	]);
});
