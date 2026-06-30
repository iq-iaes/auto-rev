@extends('layouts.app')

@section('title', 'Otomasi')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Workspace Otomasi</h2>

                <form method="POST" action="{{ route('automation.execute') }}" id="automationForm">
                    @csrf

                    <div class="mb-4">
                        <label for="journal_id" class="block text-sm font-medium text-gray-700">Pilih Jurnal Target</label>
                        <select name="journal_id" id="journal_id" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Jurnal...</option>
                            @foreach($journals as $journal)
                                <option value="{{ $journal->id }}">{{ $journal->name }} ({{ $journal->ojs_version }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="bulk_data" class="block text-sm font-medium text-gray-700">
                            Input Data Massal (Format: ID_Paper | ID_Reviewer)
                        </label>
                        <textarea name="bulk_data" id="bulk_data" rows="10" required 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono" 
                                  placeholder="PAPER001 | REVIEWER001&#10;PAPER002 | REVIEWER002&#10;PAPER003 | REVIEWER003"></textarea>
                        <p class="mt-1 text-sm text-gray-500">Masukkan satu pasang data per baris, pisahkan dengan tanda | (pipe)</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button type="submit" id="executeBtn" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Mulai Eksekusi
                            </button>
                            <button type="button" id="clearBtn" 
                                    class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded">
                                Bersihkan
                            </button>
                        </div>
                        <div id="urlCount" class="text-sm text-gray-500">0 URL akan dieksekusi</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bulkData = document.getElementById('bulk_data');
    const urlCount = document.getElementById('urlCount');
    const clearBtn = document.getElementById('clearBtn');

    bulkData.addEventListener('input', function() {
        const lines = this.value.split('\n').filter(line => line.trim() !== '');
        const validLines = lines.filter(line => line.includes('|'));
        urlCount.textContent = validLines.length + ' URL akan dieksekusi';
    });

    clearBtn.addEventListener('click', function() {
        bulkData.value = '';
        urlCount.textContent = '0 URL akan dieksekusi';
    });

    document.getElementById('automationForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('executeBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Memproses...
        `;
    });
});
</script>
@endpush
@endsection