@extends('layouts.app')

@section('title', 'Edit Jurnal')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Edit Jurnal</h2>
                    <a href="{{ route('journals.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Kembali
                    </a>
                </div>

                <form method="POST" action="{{ route('journals.update', $journal) }}" id="editJournalForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Jurnal <span class="text-red-600">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $journal->name) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                               placeholder="Masukkan nama jurnal" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="base_url" class="block text-sm font-medium text-gray-700">Base URL <span class="text-red-600">*</span></label>
                        <input type="url" name="base_url" id="base_url" value="{{ old('base_url', $journal->base_url) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('base_url') border-red-500 @enderror"
                               placeholder="https://example.com" required>
                        @error('base_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="ojs_version" class="block text-sm font-medium text-gray-700">Versi OJS <span class="text-red-600">*</span></label>
                        <select name="ojs_version" id="ojs_version" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('ojs_version') border-red-500 @enderror"
                                required>
                            <option value="3.3.0" {{ old('ojs_version', $journal->ojs_version) == '3.3.0' ? 'selected' : '' }}>OJS 3.3.0</option>
                            <option value="3.2.0" {{ old('ojs_version', $journal->ojs_version) == '3.2.0' ? 'selected' : '' }}>OJS 3.2.0</option>
                            <option value="3.1.0" {{ old('ojs_version', $journal->ojs_version) == '3.1.0' ? 'selected' : '' }}>OJS 3.1.0</option>
                            <option value="3.0.0" {{ old('ojs_version', $journal->ojs_version) == '3.0.0' ? 'selected' : '' }}>OJS 3.0.0</option>
                            <option value="2.4.8" {{ old('ojs_version', $journal->ojs_version) == '2.4.8' ? 'selected' : '' }}>OJS 2.4.8</option>
                        </select>
                        @error('ojs_version')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror"
                                  placeholder="Masukkan deskripsi jurnal">{{ old('description', $journal->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="is_active" class="inline-flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" 
                                   {{ old('is_active', $journal->is_active) ? 'checked' : '' }} 
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                        <p class="mt-1 text-sm text-gray-500">Nonaktifkan jika jurnal tidak digunakan untuk sementara</p>
                    </div>

                    <!-- Preview URL Template -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Preview URL Template:</h4>
                        <code class="text-xs bg-white p-2 rounded block break-all text-gray-600">
                            {{ $journal->base_url }}/index.php/{journal}/manager/assignReviewer/{paperId}?reviewerId={reviewerId}
                        </code>
                        <p class="mt-1 text-xs text-gray-500">URL akan digenerate otomatis saat eksekusi</p>
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('journals.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded">
                            Batal
                        </a>
                        <button type="submit" id="submitBtn"
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Update Jurnal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editJournalForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function(e) {
        // Validasi sebelum submit
        const name = document.getElementById('name').value.trim();
        const baseUrl = document.getElementById('base_url').value.trim();
        const ojsVersion = document.getElementById('ojs_version').value;

        if (!name) {
            e.preventDefault();
            alert('Nama jurnal wajib diisi!');
            document.getElementById('name').focus();
            return false;
        }

        if (!baseUrl) {
            e.preventDefault();
            alert('Base URL wajib diisi!');
            document.getElementById('base_url').focus();
            return false;
        }

        if (!ojsVersion) {
            e.preventDefault();
            alert('Versi OJS wajib dipilih!');
            document.getElementById('ojs_version').focus();
            return false;
        }

        // Validasi URL format
        try {
            new URL(baseUrl);
        } catch (_) {
            e.preventDefault();
            alert('Base URL tidak valid. Pastikan format URL benar (contoh: https://example.com)');
            document.getElementById('base_url').focus();
            return false;
        }

        // Disable tombol submit untuk mencegah double submit
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menyimpan...
        `;
    });

    // Preview URL saat base_url berubah
    document.getElementById('base_url').addEventListener('input', function() {
        const preview = this.value + '/index.php/{journal}/manager/assignReviewer/{paperId}?reviewerId={reviewerId}';
        const previewElement = document.querySelector('.bg-gray-50 code');
        if (previewElement) {
            previewElement.textContent = preview;
        }
    });
});
</script>
@endpush
@endsection