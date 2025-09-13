<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
	
	protected $fillable = [
		'full_name', 'email', 'phone', 'birthday', 'company_name', 'address',
		'suburb', 'state', 'postcode', 'note', 'source', 'tag_id',
		'total_orders', 'total_spent', 'last_order_at', 'created_by',
	];

	protected $casts = [
		'birthday' => 'date',
		'last_order_at' => 'datetime',
		'total_orders' => 'integer',
		'total_spent' => 'decimal:2',
	];

	public function orders(): HasMany
	{
		return $this->hasMany(Order::class, 'customer_id');
	}

	public function activities(): HasMany
	{
		return $this->hasMany(Activity::class, 'customer_id');
	}

	public function tags(): HasMany
	{
		return $this->hasMany(CustomerTag::class, 'customer_id');
	}

	public function stats(): HasOne
	{
		return $this->hasOne(CustomerStat::class, 'customer_id');
	}

	public function recommendations(): HasMany
	{
		return $this->hasMany(Recommendation::class, 'customer_id');
	}
} 
