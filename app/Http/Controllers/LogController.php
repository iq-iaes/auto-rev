<?php

namespace App\Http\Controllers;

use App\Models\AutomationJob;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $query = AutomationJob::with('journal', 'jobItems');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(20);
        
        $stats = [
            'total' => AutomationJob::count(),
            'completed' => AutomationJob::where('status', 'completed')->count(),
            'failed' => AutomationJob::where('status', 'failed')->count(),
            'pending' => AutomationJob::where('status', 'pending')->count(),
        ];

        return view('logs.index', compact('logs', 'stats'));
    }

    public function export(Request $request)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="logs_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($request) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Journal', 'Session Name', 'Total Items', 'Success', 'Failed', 'Status', 'Created At', 'Completed At']);

            $query = AutomationJob::with('journal');
            
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $logs = $query->orderBy('created_at', 'desc')->get();

            foreach ($logs as $log) {
                fputcsv($handle, [
                    $log->id,
                    $log->journal->name,
                    $log->session_name,
                    $log->total_items,
                    $log->success_count,
                    $log->failed_count,
                    $log->status,
                    $log->created_at,
                    $log->completed_at
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}