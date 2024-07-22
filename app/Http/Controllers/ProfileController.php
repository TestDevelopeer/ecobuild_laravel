<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	/**
	 * Display the user's profile form.
	 */
	public function index(Request $request): View
	{
		switch ($request->type) {
			case 'results':
				$breadcrumbText = 'Результаты';
				break;
			case 'rewards':
				$breadcrumbText = 'Награды';
				break;
			case 'creative':
				$breadcrumbText = 'Креативное задание';
				break;
			case 'faq':
				$breadcrumbText = 'FAQ';
				break;
			default:
				$breadcrumbText = $request->user()->surname . ' ' . $request->user()->name . ' ' . $request->user()->patronymic;
				break;
		}

		$menuButtons = [
			[
				'icon' => 'fa-light fa-medal',
				'title' => 'Награды',
				'type' => 'rewards'
			],
			[
				'icon' => 'fa-light fa-pen-swirl',
				'title' => 'Креативное задание',
				'type' => 'creative'
			],
			[
				'icon' => 'fa-light fa-messages-question',
				'title' => 'FAQ',
				'type' => 'faq'
			],
		];

		$results = $request->user()->results;

		return view('pages.profile.index', [
			'breadcrumb' => [
				'pageName' => 'Профиль',
				'breadcrumb' => [
					['text' => $breadcrumbText]
				]
			],
			'menuButtons' => $menuButtons,
			'type' => $request->type,
			'user' => $request->user(),
			'tests' => Test::all(),
			'diplomConfig' => config('custom.diplom'),
			'results' => $results,
		]);
	}
}
