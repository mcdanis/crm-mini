<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

	protected $fillable = [
		'currency',
		'timezone',
		'language',
		'updated_at',
		'created_at'
	];
}
