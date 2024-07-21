<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	return null;
});

Route::middleware('auth')->group(function () {
	Route::get('/dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('/profile/{type?}', [ProfileController::class, 'index'])->name('profile');

	Route::get('/contact', [ContactController::class, 'index'])->name('contact');

	Route::get('/test/create', [TestController::class, 'create'])->name('test.create');
	Route::get('/test/edit/{id}', [TestController::class, 'edit'])->name('test.edit');
	Route::get('/test/all', [TestController::class, 'all'])->name('test.all');

	Route::post('/test/add', [TestController::class, 'add'])->name('test.add');
	Route::post('/test/save', [TestController::class, 'save'])->name('test.save');
	Route::post('/test/delete', [TestController::class, 'delete'])->name('test.delete');

	Route::post('/question/add', [QuestionController::class, 'add'])->name('question.add');
	Route::post('/question/save', [QuestionController::class, 'save'])->name('question.save');
	Route::post('/question/delete', [QuestionController::class, 'delete'])->name('question.delete');
	Route::post('/question/asset/delete', [QuestionController::class, 'assetDelete'])->name('question.asset.delete');
	Route::post('/question/asset/get', [QuestionController::class, 'assetGet'])->name('question.asset.get');

	Route::post('/answer/delete', [AnswerController::class, 'delete'])->name('answer.delete');
});

require __DIR__ . '/auth.php';
