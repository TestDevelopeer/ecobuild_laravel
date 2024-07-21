<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Type;
use App\Helpers\Helper;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
	public function create()
	{
		return view('pages.test.create', [
			'breadcrumb' => [
				'pageName' => 'Администратор',
				'breadcrumb' => [
					['text' => 'Тестирование'],
					['text' => 'Создать'],
				]
			],
		]);
	}

	public function edit(Request $request)
	{
		$test = Test::findOrFail($request->id);
		$questions = $test->questions()->paginate(10);
		$questionTypes = Type::all();
		$questionEdit = null;

		if ($request->question) {
			$questionEdit = Question::findOrFail($request->question);
			$path = config('custom.tests.path') . "$test->id/questions/$questionEdit->id/{$questionEdit->type->slug}";
			$questionEdit->assets = Storage::files($path);
		}

		return view('pages.test.edit.index', [
			'breadcrumb' => [
				'pageName' => 'Администратор',
				'breadcrumb' => [
					['text' => 'Тестирование'],
					[
						'text' => 'Редактировать',
						'link' => route('test.all')
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

	public function all()
	{
		return view('pages.test.all', [
			'breadcrumb' => [
				'pageName' => 'Администратор',
				'breadcrumb' => [
					['text' => 'Тестирование'],
					['text' => 'Все тесты'],
				]
			],
			'tests' => Test::orderBy('id', 'desc')->paginate(10)
		]);
	}

	public function add(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'icon' => [
				'required',
				File::image()
			]
		]);

		$test = Test::create([
			'name' => $request->name,
			'slug' => Str::slug($request->name, '-')
		]);

		if ($test) {
			$path = config('custom.tests.path') . $test->id;
			$test->icon = Helper::uploadFiles($path, $request->icon);
			$test->save();
		}

		return redirect(route('test.edit', ['id' => $test->id]));
	}

	public function save(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'icon' => [
				File::image()
			]
		]);

		$test = Test::findOrFail($request->id);
		$test->fill([
			'name' => $request->name,
			'slug' => Str::slug($request->name, '-')
		]);

		if ($request->icon) {
			Storage::delete($test->icon);
			$path = config('custom.tests.path') . $test->id;
			$test->icon = Helper::uploadFiles($path, $request->icon);
		}

		if ($test->save()) {
			return redirect()->back()->with(['status' => 'success']);
		} else {
			return redirect()->back()->with(['status' => 'error']);
		}
	}

	public function delete(Request $request)
	{
		if (Test::findOrFail($request->id)->delete()) {
			$path = config('custom.tests.path') . $request->id;
			Helper::deleteFolder($path);
			return response()->json(['success' => true]);
		} else {
			return response()->json(['success' => false]);
		}
	}
}
