<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
	protected $table = 'activities';

	protected $fillable = [
		'customer_id', 'order_id', 'activity_type', 'activity_subtype', 'title',
		'body', 'occurred_at', 'created_by',
	];

	protected $casts = [
		'occurred_at' => 'datetime',
	];

	public function customer(): BelongsTo
	{
		return $this->belongsTo(Customer::class, 'customer_id');
	}

	public function order(): BelongsTo
	{
		return $this->belongsTo(Order::class, 'order_id');
	}

	public function creator(): BelongsTo
	{
		return $this->belongsTo(User::class, 'created_by');
	}
} 
