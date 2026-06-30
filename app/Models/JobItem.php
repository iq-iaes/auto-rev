<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'automation_job_id',
        'paper_id',
        'reviewer_id',
        'generated_url',
        'status',
        'error_message',
        'executed_at'
    ];

    protected $casts = [
        'executed_at' => 'datetime'
    ];

    public function automationJob()
    {
        return $this->belongsTo(AutomationJob::class);
    }
}