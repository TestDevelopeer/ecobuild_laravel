<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Answer;
use App\Helpers\Helper;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
	public function add(Request $request)
	{
		if ($request->type_id != 1) {
			$request->validate([
				'question_assets' => 'required',
			]);
		}

		$request->validate([
			'text' => 'required',
			'type_id' => 'required',
			'test_id' => 'required',
			'answers' => 'required',
			'answers.*.text' => 'required'
		]);

		$question = Question::create([
			'text' => $request->text,
			'type_id' => $request->type_id,
			'test_id' => $request->test_id
		]);

		if ($question) {
			if ($question->type_id != 1) {
				$path = config('custom.tests.path') . "$request->test_id/questions/$question->id/{$question->type->slug}";
				Helper::uploadFiles($path, $request->question_assets);
			}

			foreach ($request->answers as $key => $answer) {
				Answer::create([
					'question_id' => $question->id,
					'text' => $answer['text'],
					'is_true' => $key == $request->is_true
				]);
			}

			return redirect()->back()->with(['status' => 'success']);
		}

		return redirect()->back()->with(['status' => 'error']);
	}

	public function save(Request $request)
	{
		$request->validate([
			'text' => 'required',
			'type_id' => 'required',
			'test_id' => 'required',
			'question_id' => 'required',
			'answers.0.text' => 'required'
		]);

		$question = Question::findOrFail($request->question_id);
		$question->fill([
			'text' => $request->text,
			'type_id' => $request->type_id,
		]);

		if ($question->save()) {
			if ($question->type_id != 1 && $request->question_assets) {
				$path = config('custom.tests.path') . "$request->test_id/questions/$question->id/{$question->type->slug}";
				Helper::uploadFiles($path, $request->question_assets);
			}

			foreach ($request->answers as $key => $ans) {
				if (isset($ans['answer_id'])) {
					$answer = Answer::findOrFail($ans['answer_id']);
					$answer->fill([
						'text' => $ans['text'],
						'is_true' => $key == $request->is_true
					]);
					$answer->save();
				} else {
					if ($ans['text'] != null) {
						Answer::create([
							'question_id' => $question->id,
							'text' => $ans['text'],
							'is_true' => $key == $request->is_true
						]);
					}
				}
			}

			return redirect()->back()->with(['status' => 'success']);
		}

		return redirect()->back()->with(['status' => 'error']);
	}

	public function delete(Request $request)
	{
		$question = Question::findOrFail($request->id);

		if ($question->delete()) {
			$path = config('custom.tests.path') . "$question->test_id/questions/$question->id";
			Helper::deleteFolder($path);
			return response()->json(['success' => true]);
		} else {
			return response()->json(['success' => false]);
		}
	}
	public function assetDelete(Request $request)
	{
		if (Helper::deleteFile($request->path)) {
			return response()->json(['success' => true]);
		} else {
			return response()->json(['success' => false]);
		}
	}
	public function assetGet(Request $request)
	{
		$question = Question::findOrFail($request->id);
		$type = Type::findOrFail($request->type_id);
		$path = config('custom.tests.path') . "$question->test_id/questions/$question->id/{$type->slug}";
		$question->assets = Storage::files($path);
		$question->type_id = $request->type_id;
		if ($question->assets) {
			return response(['assets' => view('pages.test.edit.questions.question-asset', ['questionEdit' => $question])->render()]);
		} else {
			return response()->json(['success' => false]);
		}
	}
}
