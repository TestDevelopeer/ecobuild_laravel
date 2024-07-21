<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
	public function destroy(Request $request)
	{
		Answer::findOrFail($request->id)->delete();
		return response(['success' => true]);
	}
}
