<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
	Route::resources([
		'users' => UserController::class,
	]);
});
