<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\File as FileFolder;

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
			$path = public_path(config('custom.tests_path') . $test->id);

			$imageName = time() . '.' . $request->icon->getClientOriginalExtension();
			$request->icon->move("$path/icon/", $imageName);

			FileFolder::makeDirectory("$path/questions", $mode = 0777, true, true);
			FileFolder::makeDirectory("$path/creative", $mode = 0777, true, true);

			$test->icon = $imageName;
			$test->save();
		}

		return redirect(route('test.edit', ['id' => $test->id]));
	}

	public function edit(Request $request)
	{
	}
	public function delete(Request $request)
	{
		if (Test::findOrFail($request->id)->delete()) {
			$path = public_path(config('custom.tests_path') . $request->id);
			FileFolder::deleteDirectory($path);
			return response()->json(['success' => true]);
		} else {
			return response()->json(['success' => false]);
		}
	}

	public function all(Request $request)
	{
		return view('pages.test.all', [
			'breadcrumb' => [
				'pageName' => 'Администратор',
				'breadcrumb' => [
					['text' => 'Тестирование'],
					['text' => 'Все тесты'],
				]
			],
			'tests' => Test::paginate(10)
		]);
	}
}
