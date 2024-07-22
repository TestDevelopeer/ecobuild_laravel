<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Test;
use App\Models\Type;
use App\Models\Result;
use App\Helpers\Helper;
use App\Models\Question;
use Illuminate\Support\Str;
use App\Models\RewardConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Test\StoreTestRequest;
use App\Http\Requests\Test\UpdateTestRequest;

class TestController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(Test::class, 'test');
	}
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$tests = Test::orderBy('id', 'desc')->paginate(10);

		return view('pages.tests.index', [
			'breadcrumb' => [
				'pageName' => 'Администратор',
				'breadcrumb' => [
					['text' => 'Тестирование'],
					['text' => 'Все тесты'],
				]
			],
			'tests' => $tests
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('pages.tests.create', [
			'breadcrumb' => [
				'pageName' => 'Администратор',
				'breadcrumb' => [
					['text' => 'Тестирование'],
					['text' => 'Создать'],
				]
			],
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreTestRequest $request)
	{
		$test = Test::create([
			'name' => $request->name,
			'slug' => Str::slug($request->name, '-')
		]);

		if ($test) {
			$path = config('custom.tests.path') . $test->id;
			$test->icon = Helper::uploadFiles($path, $request->icon);
			Helper::uploadFiles("$path/certificate", $request->certificate);
			Helper::uploadFiles("$path/diplom", $request->diplom);
			$test->save();

			RewardConfig::create([
				'test_id' => $test->id,
				'type' => 'diplom'
			]);
			RewardConfig::create([
				'test_id' => $test->id,
				'type' => 'certificate'
			]);
		}

		return redirect(route('tests.edit', ['test' => $test->id]));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Request $request, Test $test)
	{
		$quizRemainigCount = $request->user()->quiz($test->id)->count();
		$quizReady = $request->user()->quiz($test->id)->where('answer_id', '!=', null);

		if ($quizRemainigCount == $quizReady->count()) {
			if ($request->render) {
				return response(['redirect' => route('tests.completed', ['test' => $test->id])]);
			}
			return redirect(route('tests.completed', ['test' => $test->id]));
		}

		if ($quizRemainigCount == 0) {
			foreach ($test->questionsForQuiz as $question) {
				Quiz::firstOrCreate([
					'user_id' => $request->user()->id,
					'test_id' => $test->id,
					'question_id' => $question->id,
				]);
			}
		}

		$remainigQuiz = $request->session()->get("remainigQuiz.{$test->id}");

		if (!$remainigQuiz || !Quiz::find($remainigQuiz->id)) {
			$remainigQuiz = Quiz::where('user_id', '=', $request->user()->id)
				->where('test_id', '=', $test->id)
				->where('answer_id', '=', null)
				->inRandomOrder()
				->first();
		}

		$remainigQuiz->refresh();
		$request->session()->put("remainigQuiz.{$test->id}", $remainigQuiz);

		if ($remainigQuiz->question->type_id > 1) {
			$path = config('custom.tests.path') . "$test->id/questions/$remainigQuiz->question_id/{$remainigQuiz->question->type->slug}";
			$remainigQuiz->assets = Storage::files($path);
		}

		if ($request->render) {
			$view = view('pages.quizzes.quiz-template', [
				'remainigQuiz' => $remainigQuiz,
				'quizRemainigCount' => $quizRemainigCount,
				'quizReadyCount' => $quizReady->count(),
			]);
			return response(['html' => $view->render()]);
		}

		return view('pages.quizzes.index', [
			'breadcrumb' => [
				'pageName' => 'Тестирование',
				'breadcrumb' => [
					['text' => $test->name],
				]
			],
			'remainigQuiz' => $remainigQuiz,
			'quizRemainigCount' => $quizRemainigCount,
			'quizReadyCount' => $quizReady->count(),
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Request $request, Test $test)
	{
		$questions = $test->questions()->paginate(10);
		$questionTypes = Type::all();
		$questionEdit = null;

		if ($request->question) {
			$questionEdit = Question::findOrFail($request->question);
			$path = config('custom.tests.path') . "$test->id/questions/$questionEdit->id/{$questionEdit->type->slug}";
			$questionEdit->assets = Storage::files($path);
		}

		$path = config('custom.tests.path') . $test->id;
		$test->certificate = Storage::files("$path/certificate")[0] ?? '';
		$test->diplom = Storage::files("$path/diplom")[0] ?? '';

		$certificateConfig = $test->configByType('certificate')->first();
		if (!$certificateConfig) {
			$certificateConfig = RewardConfig::create([
				'test_id' => $test->id,
				'type' => 'certificate'
			]);
		}
		$diplomConfig = $test->configByType('diplom')->first();
		if (!$diplomConfig) {
			$diplomConfig = RewardConfig::create([
				'test_id' => $test->id,
				'type' => 'diplom'
			]);
		}

		return view('pages.tests.edit', [
			'breadcrumb' => [
				'pageName' => 'Администратор',
				'breadcrumb' => [
					['text' => 'Тестирование'],
					[
						'text' => 'Редактировать',
						'link' => route('tests.index')
					],
					['text' => $test->name],
				]
			],
			'test' => $test,
			'questions' => $questions,
			'questionTypes' => $questionTypes,
			'questionEdit' => $questionEdit,
			'certificateConfig' => $certificateConfig,
			'diplomConfig' => $diplomConfig
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateTestRequest $request, Test $test)
	{
		$test->fill([
			'name' => $request->name,
			'slug' => Str::slug($request->name, '-')
		]);

		$path = config('custom.tests.path') . $test->id;
		if ($request->icon) {
			Storage::delete($test->icon);
			$test->icon = Helper::uploadFiles($path, $request->icon);
		}

		if ($request->certificate) {
			$certificate = Storage::files("$path/certificate")[0] ?? '';
			Storage::delete($certificate);
			Helper::uploadFiles("$path/certificate", $request->certificate);
		}
		if ($request->diplom) {
			$diplom = Storage::files("$path/diplom")[0] ?? '';
			Storage::delete($diplom);
			Helper::uploadFiles("$path/diplom", $request->diplom);
		}

		$test->save();

		return redirect()->back()->with(['status' => 'success']);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Test $test)
	{
		$test->delete();
		$path = config('custom.tests.path') . $test->id;
		Helper::deleteFolder($path);
		return response()->json(['success' => true]);
	}

	public function completed(Request $request, Test $test)
	{
		$quizResult = Result::where('user_id', '=', $request->user()->id)->where('test_id', '=', $test->id)->first();
		if (!$quizResult) {
			$quizReady = $request->user()->quiz($test->id);
			if ($request->user()->quiz($test->id)->where('answer_id', '=', null)->first()) {
				return redirect(route('tests.show', ['test' => $test->id]));
			}
			$cntTrueAnswers = 0;
			foreach ($quizReady->get() as $key => $value) {
				if ($value->answer->is_true) {
					$cntTrueAnswers++;
				}
			}
			$quizResult = Result::create([
				'user_id' => $request->user()->id,
				'test_id' => $test->id,
				'points' => $cntTrueAnswers / $quizReady->count() * 100
			]);
		}

		return view('pages.quizzes.completed', [
			'breadcrumb' => [
				'pageName' => 'Тестирование',
				'breadcrumb' => [
					['text' => $test->name],
				]
			],
		]);
	}

	public function rewardConfig(Request $request)
	{
		$config = RewardConfig::findOrFail($request->id);

		$config->update([
			'x_coord' => $request->x_coord,
			'y_coord' => $request->y_coord,
			'x_degree_coord' => $request->x_degree_coord ?? 0,
			'y_degree_coord' => $request->y_degree_coord ?? 0,
			'font_size' => $request->font_size,
			'font_color' => $request->font_color,
			'degree_font_size' => $request->degree_font_size ?? 0,
			'degree_font_color' => $request->degree_font_color ?? 0,
		]);

		return response(['status' => 'success']);
	}
}
