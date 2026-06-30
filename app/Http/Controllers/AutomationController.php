<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\AutomationJob;
use App\Models\JobItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AutomationController extends Controller
{
    public function index()
    {
        $journals = Journal::where('is_active', true)->get();
        return view('automation.index', compact('journals'));
    }

    public function execute(Request $request)
    {
        $request->validate([
            'journal_id' => 'required|exists:journals,id',
            'bulk_data' => 'required|string',
        ]);

        $journal = Journal::findOrFail($request->journal_id);
        
        // Parse bulk data
        $lines = explode("\n", trim($request->bulk_data));
        $items = [];
        
        foreach ($lines as $line) {
            $parts = explode('|', trim($line));
            if (count($parts) === 2) {
                $items[] = [
                    'paper_id' => trim($parts[0]),
                    'reviewer_id' => trim($parts[1])
                ];
            }
        }

        if (empty($items)) {
            return back()->with('error', 'Data tidak valid. Pastikan format: ID_Paper | ID_Reviewer');
        }

        // Create automation job
        $job = AutomationJob::create([
            'journal_id' => $journal->id,
            'session_name' => 'Session ' . Carbon::now()->format('Y-m-d H:i:s'),
            'total_items' => count($items),
            'status' => 'processing',
            'started_at' => Carbon::now()
        ]);

        // Generate URLs and create job items
        $generatedUrls = [];
        foreach ($items as $item) {
            $url = $journal->base_url . '/index.php/' . 
                   Str::slug($journal->name) . '/editor/selectReviewer/' . 
                   $item['paper_id'] . '/' . $item['reviewer_id'];

            JobItem::create([
                'automation_job_id' => $job->id,
                'paper_id' => $item['paper_id'],
                'reviewer_id' => $item['reviewer_id'],
                'generated_url' => $url,
                'status' => 'pending'
            ]);

            $generatedUrls[] = $url;
        }

        // Update job status
        $job->update([
            'status' => 'completed',
            'completed_at' => Carbon::now(),
            'success_count' => count($items)
        ]);

        // Return view with URLs to be opened in new tabs
        return view('automation.result', compact('job', 'generatedUrls'));
    }

    public function show(AutomationJob $job)
    {
        $job->load('journal', 'jobItems');
        return view('automation.show', compact('job'));
    }

    public function export(AutomationJob $job)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="execution_log_' . $job->id . '.csv"',
        ];

        $callback = function() use ($job) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Paper ID', 'Reviewer ID', 'Generated URL', 'Status', 'Executed At', 'Error Message']);

            foreach ($job->jobItems as $item) {
                fputcsv($handle, [
                    $item->paper_id,
                    $item->reviewer_id,
                    $item->generated_url,
                    $item->status,
                    $item->executed_at,
                    $item->error_message
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}