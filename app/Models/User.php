<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'surname',
		'patronymic',
		'city',
		'phone',
		'school',
		'classroom',
		'teacher',
		'teacher_job',
		'link',
		'ip',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'password' => 'hashed',
	];

	public function succesResultsForCreative()
	{
		return $this->hasMany(Result::class)->where('points', '>', config('custom.creative.min'))->get();
	}

	public function lastOneSuccessResultForCreative()
	{
		return $this->hasOne(Result::class)->where('points', '>', config('custom.creative.min'))->first();
	}
}
