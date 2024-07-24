<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
	Route::resources([
		'users' => UserController::class,
	]);

	Route::controller(UserController::class)->group(function () {
		Route::patch('/users/{user}/refresh/{test}', 'refresh')->name('users.refresh');
	});
});
