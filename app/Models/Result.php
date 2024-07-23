<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'test_id',
		'points',
		'creative_upload'
	];

	public function test()
	{
		return $this->belongsTo(Test::class);
	}
}
