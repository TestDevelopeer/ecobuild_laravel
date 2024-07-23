<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Type;
use App\Helpers\Helper;
use App\Models\Creative;
use App\Models\Question;
use Illuminate\Support\Str;
use App\Models\RewardConfig;
use Illuminate\Http\Request;
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

		if ($request->creative_text) {
			Creative::updateOrCreate(
				['test_id' => $test->id],
				[
					'text' => $request->creative_text,
					'html' => $request->creative_html
				]
			);
		}

		$test->save();

		return redirect()->back()->with(['status' => 'success', 'message' => 'Тестирование успешно сохранено']);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Test $test)
	{
		$creative = Creative::find($test->creative->id);
		$creative->creativeUpload()->delete();
		$test->delete();
		$path = config('custom.tests.path') . $test->id;
		Helper::deleteFolder($path);
		return response()->json(['success' => true]);
	}

	public function updateConfig(Request $request)
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

		return response(['status' => 'success', 'message' => "Настройки " . ($config->type == 'certificate' ? 'сертификата' : 'диплома') . " успешно сохранены"]);
	}
}
