<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Test;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(User::class, 'user');
	}
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		//dd($request->all());
		if ($request->search) {
			$users = User::orderBy('id', 'desc');
			foreach ($request->search as $key => $value) {
				if ($value != '') {
					$users->where($key, '=', $value);
				}
			}
			$users = $users->paginate(15);
		} else {
			$users = User::orderBy('id', 'desc')->paginate(15);
		}
		return view('pages.users.index', [
			'breadcrumb' => [
				'pageName' => 'Администратор',
				'breadcrumb' => [
					['text' => 'Пользователи'],
					['text' => 'Все пользователи'],
				]
			],
			'users' => $users,
			'search' => $request->search ?? null
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreUserRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(User $user)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(User $user)
	{
		$menuButtons = [
			[
				'icon' => 'fa-light fa-medal',
				'title' => 'Результаты',
				'type' => 'results'
			],
			[
				'icon' => 'fa-light fa-medal',
				'title' => 'Креативное задание',
				'type' => 'creative'
			],
		];

		$results = $user->results;
		foreach ($results as $key => $res) {
			$res->quiz = Quiz::where('user_id', '=', $user->id)->where('test_id', '=', $res->test_id)->get();
		}

		$creatives = $user->creative;

		return view('pages.users.edit', [
			'breadcrumb' => [
				'pageName' => 'Администратор',
				'breadcrumb' => [
					[
						'text' => 'Пользователи',
						'link' => route('users.index')
					],
					['text' => "{$user->surname} {$user->name}"],
				]
			],
			'tests' => Test::all(),
			'user' => $user,
			'menuButtons' => $menuButtons,
			'results' => $results,
			'creatives' => $creatives
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateUserRequest $request, User $user)
	{
		$user->update([
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
			'link' => $request->link,
			'role' => $request->role,
		]);

		return redirect()->back()->with(['status' => 'success', 'message' => 'Пользователь успешно сохранен']);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(User $user)
	{
		//
	}

	public function refresh(User $user, Test $test)
	{
		$test->resultByUser($user->id)->delete();
		$user->quiz($test->id)->delete();
		$test->creative->creativeUpload()->where('user_id', '=', $user->id)->delete();
		$path = config('custom.tests.path') . "$test->id/users/$user->id";
		Helper::deleteFolder($path);

		return redirect()->back()->with(['status' => 'success', 'message' => 'Тестирование сброшено']);
	}
}
