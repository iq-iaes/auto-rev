<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::orderBy('created_at', 'desc')->get();
        return view('journals.index', compact('journals'));
    }

    public function create()
    {
        return view('journals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:journals',
            'base_url' => 'required|url|max:255',
            'ojs_version' => 'required|string|max:20',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Journal::create($validated);

        return redirect()->route('journals.index')
            ->with('success', 'Jurnal berhasil ditambahkan.');
    }

    public function show(Journal $journal)
    {
        return view('journals.show', compact('journal'));
    }

    public function edit(Journal $journal)
    {
        return view('journals.edit', compact('journal'));
    }

    public function update(Request $request, Journal $journal)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('journals')->ignore($journal->id)
            ],
            'base_url' => 'required|url|max:255',
            'ojs_version' => 'required|string|max:20',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $journal->update($validated);

        return redirect()->route('journals.index')
            ->with('success', 'Jurnal berhasil diperbarui.');
    }

    public function destroy(Journal $journal)
    {
        $journal->delete();
        
        return redirect()->route('journals.index')
            ->with('success', 'Jurnal berhasil dihapus.');
    }

    public function toggleStatus(Journal $journal)
    {
        $journal->is_active = !$journal->is_active;
        $journal->save();

        return redirect()->route('journals.index')
            ->with('success', 'Status jurnal berhasil diubah.');
    }
}