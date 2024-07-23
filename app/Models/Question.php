<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	use HasFactory;

	protected $fillable = [
		'text',
		'html',
		'type_id',
		'test_id'
	];

	public function answers()
	{
		return $this->hasMany(Answer::class);
	}

	public function quizzes()
	{
		return $this->hasMany(Quiz::class);
	}

	public function answersForQuiz()
	{
		return $this->hasMany(Answer::class)->inRandomOrder();
	}

	public function type()
	{
		return $this->belongsTo(Type::class);
	}



	public function delete()
	{
		$this->answers()->delete();
		$this->quizzes()->delete();

		return parent::delete();
	}
}
