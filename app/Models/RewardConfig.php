<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardConfig extends Model
{
	use HasFactory;

	protected $fillable = [
		'test_id',
		'type',
		'x_coord',
		'y_coord',
		'x_degree_coord',
		'y_degree_coord',
		'font_size',
		'font_color',
		'degree_font_size',
		'degree_font_color',
	];
}
