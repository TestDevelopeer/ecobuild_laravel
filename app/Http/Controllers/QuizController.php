<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Test;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuizRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateQuizRequest;

class QuizController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Test $test)
	{
		return view('pages.quizzes.index', [
			'breadcrumb' => [
				'pageName' => 'Тестирование',
				'breadcrumb' => [
					['text' => $test->name],
				]
			],
			'test' => $test
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request, Test $test)
	{
		$user = $request->user();
		$quizResult = Result::where('user_id', '=', $user->id)->where('test_id', '=', $test->id)->first();
		if (!$quizResult) {
			$quizReady = $user->readyQuiz($test->id)->get();
			$cntTrueAnswers = 0;
			foreach ($quizReady as $value) {
				if ($value->answer->is_true) {
					$cntTrueAnswers++;
				}
			}
			Result::create([
				'user_id' => $user->id,
				'test_id' => $test->id,
				'points' => $cntTrueAnswers / $quizReady->count() * 100
			]);
		}

		return response(['redirect' => route('quizzes.completed', ['test' => $test->id])]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, Test $test)
	{
		$user = $request->user();

		$quizRemainigCount = $user->quiz($test->id)->count();

		if ($quizRemainigCount == 0) {
			foreach ($test->questionsForQuiz as $question) {
				Quiz::create([
					'user_id' => $user->id,
					'test_id' => $test->id,
					'question_id' => $question->id,
				]);
				$quizRemainigCount++;
			}
		}

		$quizReadyCount = $user->readyQuiz($test->id)->count();

		if ($quizRemainigCount == $quizReadyCount) {
			return $this->store($request, $test);
		}

		$remainigQuiz = $request->session()->get("remainigQuiz.{$test->id}");
		if (!$remainigQuiz || !Quiz::find($remainigQuiz->id)) {
			$remainigQuiz = Quiz::where('user_id', '=', $user->id)
				->where('test_id', '=', $test->id)
				->where('answer_id', '=', null)
				->inRandomOrder()
				->first();
		} else {
			$remainigQuiz->refresh();
		}
		$request->session()->put("remainigQuiz.{$test->id}", $remainigQuiz);

		if ($remainigQuiz->question->type_id > 1) {
			$path = config('custom.tests.path') . "$test->id/questions/$remainigQuiz->question_id/{$remainigQuiz->question->type->slug}";
			$remainigQuiz->assets = Storage::files($path);
		}

		$view = view('pages.quizzes.quiz-template', [
			'remainigQuiz' => $remainigQuiz,
			'quizRemainigCount' => $quizRemainigCount,
			'quizReadyCount' => $quizReadyCount,
		]);

		return response(['html' => $view->render()]);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Quiz $quiz)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateQuizRequest $request, Quiz $quiz)
	{
		$quiz->update(['answer_id' => $request->answer_id]);
		$request->session()->forget("remainigQuiz.{$quiz->test_id}");
		$test = Test::find($quiz->test_id);
		return $this->show($request, $test);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Quiz $quiz)
	{
		//
	}

	public function completed(Request $request, Test $test)
	{
		$user = $request->user();
		$quizResult = Result::where('user_id', '=', $user->id)->where('test_id', '=', $test->id)->first();
		if ($quizResult) {
			return view('pages.quizzes.completed', [
				'breadcrumb' => [
					'pageName' => 'Тестирование',
					'breadcrumb' => [
						['text' => $test->name],
					]
				],
			]);
		} else {
			return redirect()->route('quizzes.show', $test->id);
		}
	}
}
