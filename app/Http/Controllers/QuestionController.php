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
	public function uploadAssets($question, $question_assets, $test_id)
	{
		if ($question->type_id != 1 && $question_assets) {
			$path = config('custom.tests.path') . "$test_id/questions/$question->id/{$question->type->slug}";
			Helper::uploadFiles($path, $question_assets);
		}
	}

	public function add(Request $request)
	{
		$request->validate([
			'text' => 'required',
			'type_id' => 'required',
			'test_id' => 'required',
			'answers' => 'required',
			'answers.0.text' => 'required',
			'question_assets' => 'exclude_if:type_id,1|required'
		]);

		$question = Question::create([
			'text' => $request->text,
			'type_id' => $request->type_id,
			'test_id' => $request->test_id
		]);

		if ($question) {
			$this->uploadAssets($question, $request->question_assets, $request->test_id);

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
			$this->uploadAssets($question, $request->question_assets, $request->test_id);

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
		try {
			$question = Question::findOrFail($request->id);
			$path = config('custom.tests.path') . "$question->test_id/questions/$question->id";
			Helper::deleteFolder($path);
			$question->delete();
			return response()->json(['success' => true]);
		} catch (\Exception $e) {
			return response()->json(['success' => false, 'error' => $e->getMessage()]);
		}
	}

	public function assetDelete(Request $request)
	{
		try {
			if (Helper::deleteFile($request->path)) {
				return response()->json(['success' => true]);
			} else {
				return response()->json(['success' => false]);
			}
		} catch (\Exception $e) {
			return response()->json(['success' => false, 'error' => $e->getMessage()]);
		}
	}

	public function assetGet(Request $request)
	{
		try {
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
		} catch (\Exception $e) {
			return response()->json(['success' => false, 'error' => $e->getMessage()]);
		}
	}
}
