<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
	protected $fillable = [
		'email', 'full_name', 'password_hash', 'role', 'is_active', 'token', 'token_expire_at'
	];

	public function ordersCreated(): HasMany
	{
		return $this->hasMany(Order::class, 'created_by');
	}

	public function paymentsCreated(): HasMany
	{
		return $this->hasMany(Payment::class, 'created_by');
	}

	public function activitiesCreated(): HasMany
	{
		return $this->hasMany(Activity::class, 'created_by');
	}

	public function recommendationsCreated(): HasMany
	{
		return $this->hasMany(Recommendation::class, 'created_by');
	}
} 
