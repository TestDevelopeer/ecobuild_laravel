<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
	/**
	 * Display the registration view.
	 */
	public function create(): View
	{
		return view('auth.register');
	}

	/**
	 * Handle an incoming registration request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request): RedirectResponse
	{
		$request->validate([
			'surname' => ['required', 'string', 'between:3,20'],
			'name' => ['required', 'string', 'between:3,20'],
			'patronymic' => ['required', 'string', 'between:3,20'],
			'city' => ['required', 'string', 'between:3,20'],
			'phone' => ['required', 'string', 'size:16', 'unique:' . User::class],
			'school' => ['required', 'string', 'between:3,30'],
			'classroom' => ['required', 'integer', 'between:1,2'],
			'teacher' => ['required', 'string', 'between:10,30'],
			'teacher_job' => ['required', 'string', 'between:3,30'],
			'email' => ['required', 'string', 'email', 'between:5,50', 'unique:' . User::class],
			'password' => ['required', 'confirmed', Rules\Password::defaults()],
			'policy_check' => ['required'],
		]);

		$user = User::create([
			'name' => $request->name,
			'surname' => $request->surname,
			'patronymic' => $request->patronymic,
			'city' => $request->city,
			'phone' => $request->phone,
			'school' => $request->school,
			'classroom' => $request->classroom,
			'teacher' => $request->teacher,
			'teacher_job' => $request->teacher_job,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'ip' => $request->ip(),
			'link' => $request->link,
		]);

		event(new Registered($user));

		Auth::login($user);

		return redirect(RouteServiceProvider::HOME);
	}

	public function validateStep(Request $request)
	{
		switch ($request->step) {
			case 1:
				$validation = Validator::make($request->data, [
					'surname' => ['required', 'string', 'between:3,20'],
					'name' => ['required', 'string', 'between:3,20'],
					'patronymic' => ['required', 'string', 'between:3,20'],
					'city' => ['required', 'string', 'between:3,20'],
					'phone' => ['required', 'string', 'size:16', 'unique:' . User::class],
				]);
				break;
			case 2:
				$validation = Validator::make($request->data, [
					'school' => ['required', 'string', 'between:3,30'],
					'classroom' => ['required', 'integer', 'between:1,2'],
					'teacher' => ['required', 'string', 'between:10,30'],
					'teacher_job' => ['required', 'string', 'between:3,30'],
				]);
				break;
			default:
				break;
		}
		if (isset($validation) && $validation->fails()) {
			return response(['errors' => $validation->errors()], 422);
		}
	}
}
