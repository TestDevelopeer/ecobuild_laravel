<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativeUpload extends Model
{
	use HasFactory;

	protected $fillable = [
		'creative_id',
		'user_id',
		'comment'
	];
}
