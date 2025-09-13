<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{

	protected $fillable = [
		'order_id', 'payment_date', 'amount', 'payment_method', 'reference', 'note', 'created_by',
	];

	protected $casts = [
		'payment_date' => 'datetime',
		'amount' => 'decimal:2',
	];

	public function order(): BelongsTo
	{
		return $this->belongsTo(Order::class, 'order_id');
	}

	public function creator(): BelongsTo
	{
		return $this->belongsTo(User::class, 'created_by');
	}
} 