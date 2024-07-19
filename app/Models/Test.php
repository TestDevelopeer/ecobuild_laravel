<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'slug',
		'icon'
	];

	public function resultByUser()
	{
		return $this->hasOne(Result::class)->where('user_id', '=', Auth::id())->first();
	}

	public function results()
	{
		return $this->hasMany(Result::class);
	}

	public function questions()
	{
		return $this->hasMany(Question::class);
	}

	public function answers()
	{
		return $this->hasManyThrough(Answer::class, Question::class);
	}

	public function delete()
	{
		$this->answers()->delete();
		$this->questions()->delete();
		$this->results()->delete();

		return parent::delete();
	}
}
