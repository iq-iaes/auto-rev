@extends('layouts.app')

@section('title', 'Hasil Eksekusi')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Hasil Eksekusi</h2>
                    <div class="flex space-x-3">
                        <a href="{{ route('automation.export', $job) }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Ekspor CSV
                        </a>
                        <a href="{{ route('automation.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Kembali
                        </a>
                    </div>
                </div>

                <!-- Job Summary -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <div class="text-sm text-gray-500">Jurnal</div>
                            <div class="font-medium">{{ $job->journal->name }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Session</div>
                            <div class="font-medium">{{ $job->session_name }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Total Items</div>
                            <div class="font-medium">{{ $job->total_items }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Status</div>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Completed
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Generated URLs -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-medium text-gray-900">URL yang Digenerate</h3>
                        <span class="text-sm text-gray-500">Total: {{ count($generatedUrls) }} URL</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 max-h-96 overflow-y-auto">
                        @foreach($generatedUrls as $index => $url)
                            <div class="flex items-center justify-between py-2 border-b border-gray-200 last:border-0">
                                <span class="text-sm text-gray-600 font-mono">#{{ $index + 1 }}</span>
                                <a href="{{ $url }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-900 hover:underline break-all ml-2 flex-1">
                                    {{ $url }}
                                </a>
                                <a href="{{ $url }}" target="_blank" 
                                   class="ml-2 inline-flex items-center px-2 py-1 bg-blue-100 border border-transparent rounded-md text-xs font-medium text-blue-800 hover:bg-blue-200">
                                    Buka Tab
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap justify-center gap-3 mt-6">
                    <!-- Tombol Buka Semua URL -->
                    <button onclick="openAllUrls()" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Buka Semua URL ({{ count($generatedUrls) }})
                    </button>

                    <!-- Tombol Buka Semua dengan Delay -->
                    <button onclick="openAllUrlsWithDelay()" 
                            class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Buka Bertahap (1 detik interval)
                    </button>

                    <!-- Tombol Salin Semua URL -->
                    <button onclick="copyAllUrls()" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                        </svg>
                        Salin Semua URL
                    </button>
                </div>

                <!-- Notification Area -->
                <div id="notification" class="mt-4 hidden">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline" id="notificationMessage"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Data URLs dari server
    const urls = {!! json_encode($generatedUrls) !!};
    let isOpening = false;

    function showNotification(message, isError = false) {
        const notification = document.getElementById('notification');
        const messageEl = document.getElementById('notificationMessage');
        
        notification.classList.remove('hidden');
        messageEl.textContent = message;
        
        if (isError) {
            notification.querySelector('div').className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative';
        } else {
            notification.querySelector('div').className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative';
        }
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 5000);
    }

    function openAllUrls() {
        if (isOpening) return;
        if (urls.length === 0) {
            showNotification('Tidak ada URL untuk dibuka', true);
            return;
        }

        isOpening = true;
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        
        btn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Membuka ${urls.length} URL...
        `;
        btn.disabled = true;

        // Buka semua URL dengan delay kecil untuk menghindari block popup
        urls.forEach((url, index) => {
            setTimeout(() => {
                window.open(url, '_blank');
            }, index * 300);
        });

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            isOpening = false;
            showNotification(`Berhasil membuka ${urls.length} URL`);
        }, urls.length * 300 + 1000);
    }

    function openAllUrlsWithDelay() {
        if (isOpening) return;
        if (urls.length === 0) {
            showNotification('Tidak ada URL untuk dibuka', true);
            return;
        }

        isOpening = true;
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        
        btn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Membuka ${urls.length} URL (1 detik interval)...
        `;
        btn.disabled = true;

        // Buka semua URL dengan interval 1 detik
        urls.forEach((url, index) => {
            setTimeout(() => {
                window.open(url, '_blank');
            }, (index + 1) * 1000);
        });

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            isOpening = false;
            showNotification(`Berhasil membuka ${urls.length} URL dengan interval 1 detik`);
        }, urls.length * 1000 + 2000);
    }

    function copyAllUrls() {
        if (urls.length === 0) {
            showNotification('Tidak ada URL untuk disalin', true);
            return;
        }

        const text = urls.join('\n');
        
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(() => {
                showNotification(`Berhasil menyalin ${urls.length} URL ke clipboard`);
            }).catch(() => {
                // Fallback method
                copyToClipboardFallback(text);
            });
        } else {
            // Fallback method
            copyToClipboardFallback(text);
        }
    }

    function copyToClipboardFallback(text) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        textarea.style.position = 'fixed';
        textarea.style.opacity = '0';
        document.body.appendChild(textarea);
        textarea.select();
        
        try {
            document.execCommand('copy');
            showNotification(`Berhasil menyalin ${urls.length} URL ke clipboard`);
        } catch (err) {
            showNotification('Gagal menyalin URL ke clipboard', true);
        }
        
        document.body.removeChild(textarea);
    }

    // Keyboard shortcut: Ctrl+Shift+O untuk membuka semua URL
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.shiftKey && e.key === 'O') {
            e.preventDefault();
            openAllUrls();
        }
    });

    // Menampilkan total URL di console
    console.log(`Total URL yang digenerate: ${urls.length}`);
    console.log('URL List:', urls);
</script>
@endpush
@endsection