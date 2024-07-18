<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
		return view('pages.profile.index', [
			'type' => $request->type,
			'user' => $request->user(),
			'breadcrumb' => [
				'pageName' => 'Профиль',
				'breadcrumb' => [
					['text' => $breadcrumbText]
				]
			],
			'diplomConfig' => config('custom.diplom'),
		]);
	}

	/**
	 * Update the user's profile information.
	 */
	public function update(ProfileUpdateRequest $request): RedirectResponse
	{
		$request->user()->fill($request->validated());

		if ($request->user()->isDirty('email')) {
			$request->user()->email_verified_at = null;
		}

		$request->user()->save();

		return Redirect::route('profile.edit')->with('status', 'profile-updated');
	}

	/**
	 * Delete the user's account.
	 */
	public function destroy(Request $request): RedirectResponse
	{
		$request->validateWithBag('userDeletion', [
			'password' => ['required', 'current_password'],
		]);

		$user = $request->user();

		Auth::logout();

		$user->delete();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return Redirect::to('/');
	}
}
