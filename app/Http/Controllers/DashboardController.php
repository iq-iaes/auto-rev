<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\AutomationJob;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalJournals = Journal::count();
        $activeJournals = Journal::where('is_active', true)->count();
        $totalExecutions = AutomationJob::count();
        $successExecutions = AutomationJob::where('status', 'completed')->sum('success_count');
        
        $recentActivities = AutomationJob::with('journal')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard', compact(
            'totalJournals',
            'activeJournals',
            'totalExecutions',
            'successExecutions',
            'recentActivities'
        ));
    }
}