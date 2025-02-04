<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'test_id',
		'question_id',
		'answer_id'
	];

	public function question()
	{
		return $this->belongsTo(Question::class);
	}

	public function answer()
	{
		return $this->belongsTo(Answer::class);
	}
}
