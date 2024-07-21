<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
	public function delete(Request $request)
	{
		Answer::findOrFail($request->id)->delete();

		return response(['success' => true]);
	}
}
