<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creative extends Model
{
	use HasFactory;

	protected $fillable = [
		'test_id',
		'text',
		'html'
	];

	public function creativeUpload()
	{
		return $this->hasMany(CreativeUpload::class);
	}
}
