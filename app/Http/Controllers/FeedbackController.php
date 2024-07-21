<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FeedbackController extends Controller
{
	public function create(Request $request)
	{
		$request->validate([
			'phone' => ['required', 'string', 'size:16'],
			'email' => ['required', 'string', 'email', 'between:5,50'],
			'message' => ['required'],
		]);

		$feedback = Feedback::create([
			'email' => $request->email,
			'phone' => $request->phone,
			'message' => $request->message,
			'user_id' => $request->user()->id
		]);

		if ($feedback) {
			return response('success');
		} else {
			return response('error', 400);
		}
	}

	public function check(Request $request)
	{
		$feedback = Feedback::where('user_id', '=', $request->user()->id)->orderBy('id', 'desc')->first();

		if ($feedback) {
			$from_date = Carbon::parse(date('Y-m-d H:i:s', strtotime($feedback->created_at)));
			$through_date = Carbon::parse(date('Y-m-d H:i:s'));
			$difference = $from_date->diffInDays($through_date);
			if ($difference == 0) {
				return response('need more time', 400);
			}
		} else {
			return response('success');
		}
	}
}
