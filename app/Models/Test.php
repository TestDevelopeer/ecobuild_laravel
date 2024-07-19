<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
	use HasFactory;

	public function result()
	{
		return $this->hasOne(Result::class)->where('user_id', '=', Auth::id())->first();
	}
}
