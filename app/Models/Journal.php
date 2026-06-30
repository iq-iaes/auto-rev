<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'base_url',
        'ojs_version',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function automationJobs()
    {
        return $this->hasMany(AutomationJob::class);
    }

    public function getUrlTemplateAttribute()
    {
        return $this->base_url . '/index.php/{journal}/editor/selectReviewer/{paperId}/{reviewerId}';
    }
}