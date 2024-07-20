<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\File as FileFolder;

class QuestionController extends Controller
{
	public function add(Request $request)
	{
		if ($request->type_id != 1) {
			$request->validate([
				'question_asset' => 'required',
			]);
		}

		$request->validate([
			'text' => 'required',
			'type_id' => 'required',
			'test_id' => 'required',
		]);

		$type = Type::findOrFail($request->type_id);

		$question = Question::create([
			'text' => $request->text,
			'type_id' => $request->type_id,
			'test_id' => $request->test_id
		]);

		if ($question) {
			if ($question->type_id != 1) {
				$path = public_path(config('custom.tests.path') . $request->test_id);
				FileFolder::makeDirectory("$path/questions/$question->id/$type->slug", $mode = 0777, true, true);
				$assetName = time() . '.' . $request->question_asset->getClientOriginalExtension();
				$request->question_asset->move("$path/questions/$question->id/$type->slug", $assetName);
			}

			if (isset($request->answers) && $request->answers[0]['text'] != null) {
				foreach ($request->answers as $key => $answer) {
					Answer::create([
						'question_id' => $question->id,
						'text' => $answer['text'],
						'is_true' => $key == $request->is_true
					]);
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
			$path = public_path(config('custom.tests.path') . "$question->test_id/questions/$question->id");
			FileFolder::deleteDirectory($path);
			return response()->json(['success' => true]);
		} else {
			return response()->json(['success' => false]);
		}
	}
}
