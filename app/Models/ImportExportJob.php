<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImportExportJob extends Model
{
	protected $fillable = [
		'job_type', 'file_path', 'status', 'total_rows', 'processed_rows',
		'error_message', 'initiated_by', 'started_at', 'finished_at',
	];

	protected $casts = [
		'total_rows' => 'integer',
		'processed_rows' => 'integer',
		'started_at' => 'datetime',
		'finished_at' => 'datetime',
	];

	public function initiator(): BelongsTo
	{
		return $this->belongsTo(User::class, 'initiated_by');
	}
} 