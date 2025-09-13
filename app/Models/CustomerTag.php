<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerTag extends Model
{
	protected $fillable = [
		'customer_id', 'name',
	];

	public $timestamps = false; // hanya created_at

	public function customer(): BelongsTo
	{
		return $this->belongsTo(Customer::class, 'customer_id');
	}
} 