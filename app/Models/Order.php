<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

	protected $fillable = [
		'customer_id', 'status', 'order_date', 'note', 'total_amount',
		'total_paid', 'scheduled_at', 'deleted_at', 'created_by',
	];

	protected $casts = [
		'order_date' => 'date',
		'scheduled_at' => 'datetime',
		'deleted_at' => 'datetime',
		'total_amount' => 'decimal:2',
		'total_paid' => 'decimal:2',
	];

	public function customer(): BelongsTo
	{
		return $this->belongsTo(Customer::class, 'customer_id');
	}

	public function items(): HasMany
	{
		return $this->hasMany(OrderItem::class, 'order_id');
	}

	public function payments(): HasMany
	{
		return $this->hasMany(Payment::class, 'order_id');
	}

	public function creator(): BelongsTo
	{
		return $this->belongsTo(User::class, 'created_by');
	}
} 
