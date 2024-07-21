<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Type;
use App\Models\Answer;
use App\Helpers\Helper;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Question\StoreQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;

class QuestionController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(Question::class, 'question');
	}
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
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
	public function store(StoreQuestionRequest $request, Test $test)
	{
		$question = Question::create([
			'text' => $request->text,
			'type_id' => $request->type_id,
			'test_id' => $test->id
		]);

		$this->uploadAssets($question, $request->question_assets, $test->id);

		foreach ($request->answers as $key => $answer) {
			Answer::create([
				'question_id' => $question->id,
				'text' => $answer['text'],
				'is_true' => $key == $request->is_true
			]);
		}

		return redirect()->back()->with(['status' => 'success']);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Question $question)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Question $question)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateQuestionRequest $request, Question $question)
	{
		$question->update([
			'text' => $request->text,
			'type_id' => $request->type_id,
		]);

		$this->uploadAssets($question, $request->question_assets, $question->test_id);

		foreach ($request->answers as $key => $ans) {
			if (isset($ans['answer_id'])) {
				$answer = Answer::findOrFail($ans['answer_id']);
				$answer->update([
					'text' => $ans['text'],
					'is_true' => $key == $request->is_true
				]);
			} else {
				Answer::create([
					'question_id' => $question->id,
					'text' => $ans['text'],
					'is_true' => $key == $request->is_true
				]);
			}
		}

		return redirect()->back()->with(['status' => 'success']);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Question $question)
	{
		$path = config('custom.tests.path') . "$question->test_id/questions/$question->id";
		Helper::deleteFolder($path);
		$question->delete();
		return response()->json(['test_id' => $question->test_id]);
	}

	public function uploadAssets($question, $question_assets, $test_id)
	{
		if ($question->type_id != 1 && $question_assets) {
			$path = config('custom.tests.path') . "$test_id/questions/$question->id/{$question->type->slug}";
			Helper::uploadFiles($path, $question_assets);
		}
	}

	public function deleteAssets(Request $request)
	{
		Helper::deleteFile($request->path);
		return response()->json(['success' => true]);
	}

	public function getAssets(Request $request)
	{
		$question = Question::findOrFail($request->id);
		$type = Type::findOrFail($request->type_id);
		$path = config('custom.tests.path') . "$question->test_id/questions/$question->id/{$type->slug}";
		$question->assets = Storage::files($path);
		$question->type_id = $request->type_id;
		if ($question->assets) {
			return response(['assets' => view('pages.tests.questions.question-asset', ['questionEdit' => $question])->render()]);
		} else {
			return response()->json(['success' => false]);
		}
	}
}
