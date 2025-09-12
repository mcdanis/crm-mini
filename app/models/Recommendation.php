<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recommendation extends Model
{
	 
	protected $fillable = [
		'customer_id', 'recommendation_text', 'score', 'reason', 'created_by', 'acted_on', 'acted_at',
	];

	protected $casts = [
		'score' => 'float',
		'reason' => 'array',
		'acted_on' => 'boolean',
		'acted_at' => 'datetime',
	];

	public function customer(): BelongsTo
	{
		return $this->belongsTo(Customer::class, 'customer_id');
	}

	public function creator(): BelongsTo
	{
		return $this->belongsTo(User::class, 'created_by');
	}
} 