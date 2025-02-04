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

	public function resultByUser($userId)
	{
		return $this->hasOne(Result::class)->where('user_id', '=', $userId)->first();
	}

	public function results()
	{
		return $this->hasMany(Result::class);
	}

	public function questions()
	{
		return $this->hasMany(Question::class);
	}

	public function questionsForQuiz()
	{
		return $this->hasMany(Question::class)->inRandomOrder()->limit(config('custom.tests.max_questions'));
	}

	public function answers()
	{
		return $this->hasManyThrough(Answer::class, Question::class);
	}

	public function configs()
	{
		return $this->hasMany(RewardConfig::class);
	}

	public function quizzes()
	{
		return $this->hasMany(Quiz::class);
	}

	public function creative()
	{
		return $this->hasOne(Creative::class);
	}

	public function delete()
	{
		$this->answers()->delete();
		$this->questions()->delete();
		$this->results()->delete();
		$this->configs()->delete();
		$this->quizzes()->delete();
		$this->creative()->delete();

		return parent::delete();
	}

	public function configByType($type)
	{
		return $this->hasMany(RewardConfig::class)->where('type', '=', $type);
	}
}
