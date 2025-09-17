<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerStat extends Model
{
	public $timestamps = false;
	protected $primaryKey = 'customer_id';
	public $incrementing = false;
	protected $keyType = 'int';

	protected $fillable = [
		'customer_id',
		'total_orders',
		'total_spent',
		'last_order_at',
		'avg_order_value',
		'retention_score',
		'updated_at',
	];

	public function customer(): BelongsTo
	{
		return $this->belongsTo(Customer::class, 'customer_id');
	}
}
