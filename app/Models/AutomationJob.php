<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutomationJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'journal_id',
        'session_name',
        'total_items',
        'success_count',
        'failed_count',
        'status',
        'started_at',
        'completed_at',
        'notes'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }

    public function jobItems()
    {
        return $this->hasMany(JobItem::class);
    }
}