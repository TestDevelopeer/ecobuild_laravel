<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'surname' => ['required', 'string', 'between:3,20'],
			'name' => ['required', 'string', 'between:3,20'],
			'patronymic' => ['required', 'string', 'between:3,20'],
			'city' => ['required', 'string', 'between:3,20'],
			'phone' => ['required', 'string', 'size:16', 'unique:' . User::class],
			'school' => ['required', 'string', 'between:3,30'],
			'classroom' => ['required', 'integer', 'max:11'],
			'teacher' => ['required', 'string', 'between:10,30'],
			'teacher_job' => ['required', 'string', 'between:3,30'],
			'email' => ['required', 'string', 'email', 'between:5,50', 'unique:' . User::class],
			'role' => ['required', 'string'],
		];
	}
}
