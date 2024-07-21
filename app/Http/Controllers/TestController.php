<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Type;
use App\Helpers\Helper;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Test\StoreTestRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Test\UpdateTestRequest;

class TestController extends Controller
{
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
			$test->save();
		}

		return redirect(route('tests.edit', ['test' => $test->id]));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
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
			'questionEdit' => $questionEdit
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

		if ($request->icon) {
			Storage::delete($test->icon);
			$path = config('custom.tests.path') . $test->id;
			$test->icon = Helper::uploadFiles($path, $request->icon);
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
}
