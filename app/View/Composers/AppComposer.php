<?php

namespace App\View\Composers;

use App\Models\Beeline;
use App\Models\BeelineRecall;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AppComposer
{
	/**
	 * Bind data to the view.
	 *
	 * @param View $view
	 * @return void
	 */
	public function compose(View $view): void
	{
		$recall = false;
		if (Auth::check()) {
			if (BeelineRecall::where('manager_id', '=', Auth::user()->id)->where('recall_date', '<=', DB::raw('CURRENT_TIMESTAMP'))->first()) {
				$recall = true;
			}
		}
		$view->with('recall', $recall);
		$view->with('currentYear', date('Y'));
	}
}
