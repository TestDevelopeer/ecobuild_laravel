<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class RewardController extends Controller
{
	public function reward(Request $request)
	{
		$result = Result::findOrFail($request->id);

		$html = view('pages.profile.layouts.reward-cards', ['result' => $result])->render();

		return response(['html' => $html]);
	}
}
