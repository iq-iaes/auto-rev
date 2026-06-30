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

                <div class="flex flex-wrap justify-center gap-3 mt-6">
                    <button id="btn-execute" onclick="openSequentially(this)" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded font-medium transition duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Eksekusi Semua URL ({{ count($generatedUrls) }})
                    </button>

                    <button id="btn-copy" onclick="copyAllUrls()" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded font-medium transition duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                        </svg>
                        Salin Semua URL
                    </button>
                </div>

                <div id="progressContainer" class="mt-6 max-w-xl mx-auto hidden">
                    <div class="flex justify-between mb-1">
                        <span id="progressText" class="text-sm font-medium text-indigo-700">Memproses 0 dari {{ count($generatedUrls) }} URL...</span>
                        <span id="progressPercent" class="text-sm font-medium text-indigo-700">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div id="progressBar" class="bg-indigo-600 h-2.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                </div>

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

    /**
     * Menampilkan notifikasi sukses atau error di UI
     */
    function showNotification(message, isError = false) {
        const notification = document.getElementById('notification');
        const messageEl = document.getElementById('notificationMessage');
        
        if (!notification || !messageEl) return;

        notification.classList.remove('hidden');
        messageEl.textContent = message;
        
        const alertBox = notification.querySelector('div');
        if (alertBox) {
            if (isError) {
                alertBox.className = `bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative`;
            } else {
                alertBox.className = `bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative`;
            }
        }
        
        // Sembunyikan otomatis setelah 5 detik
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 5000);
    }

    /**
     * Fungsi Helper utilitas untuk memberikan jeda waktu (delay) eksesuksi 
     */
    const sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

    /**
     * Fungsi untuk mendeteksi apakah halaman pada tab target sudah selesai loading.
     * Menggunakan mekanisme try-catch sebagai proteksi apabila domain tujuan memicu Same-Origin Policy (Cross-Origin limitation).
     */
    function waitForLoad(tab) {
        return new Promise((resolve) => {
            const interval = setInterval(() => {
                try {
                    // Jika tab ditutup paksa oleh pengguna di tengah jalan
                    if (!tab || tab.closed) {
                        clearInterval(interval);
                        resolve();
                        return;
                    }
                    
                    // Cek jika status dokumen sudah complete (Hanya bekerja jika Same-Origin)
                    if (tab.document && tab.document.readyState === 'complete') {
                        clearInterval(interval);
                        resolve();
                    }
                } catch (error) {
                    // Terjadi Cross-Origin Security Error (karena perbedaan sub-domain / origin OJS).
                    // Browser memblokir pembacaan properti dokumen, berikan fallback aman sebesar 3 detik untuk loading.
                    clearInterval(interval);
                    setTimeout(resolve, 3000);
                }
            }, 500);
        });
    }

    /**
     * Mengeksekusi seluruh daftar URL secara berurutan pada SATU tab yang sama.
     */
    async function openSequentially(button) {
        if (isOpening) return;
        if (urls.length === 0) {
            showNotification(`Tidak ada URL untuk dieksekusi`, true);
            return;
        }

        isOpening = true;

        // Ambil elemen UI
        const btnCopy = document.getElementById('btn-copy');
        const progressContainer = document.getElementById('progressContainer');
        const progressText = document.getElementById('progressText');
        const progressPercent = document.getElementById('progressPercent');
        const progressBar = document.getElementById('progressBar');

        // Simpan konten asli tombol utama
        const originalButtonHtml = button.innerHTML;

        // Nonaktifkan tombol selama proses berlangsung
        button.disabled = true;
        if (btnCopy) btnCopy.disabled = true;

        // Tampilkan container progress bar
        if (progressContainer) progressContainer.classList.remove('hidden');

        // Buka tepat 1 tab kosong pertama untuk digunakan selama proses berantai
        let executionTab = window.open('about:blank', 'ojs_execution_tab');

        if (!executionTab) {
            showNotification(`Gagal membuka tab baru. Mohon izinkan izin Pop-up di browser Anda.`, true);
            button.disabled = false;
            if (btnCopy) btnCopy.disabled = false;
            if (progressContainer) progressContainer.classList.add('hidden');
            isOpening = false;
            return;
        }

        try {
            for (let i = 0; i < urls.length; i++) {
                const currentUrl = urls[i];
                const currentIndex = i + 1;

                // Hitung persentase progress saat ini
                const percentage = Math.round((currentIndex / urls.length) * 100);

                // Update text & progress bar di UI
                if (progressText) progressText.textContent = `Memproses ${currentIndex} dari ${urls.length} URL...`;
                if (progressPercent) progressPercent.textContent = `${percentage}%`;
                if (progressBar) progressBar.style.width = `${percentage}%`;

                // Update animasi loading di tombol utama
                button.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses URL #${currentIndex}...
                `;

                // Jika user tidak sengaja menutup tab eksekusi di tengah proses, buka kembali tab baru
                if (executionTab.closed) {
                    executionTab = window.open('about:blank', 'ojs_execution_tab');
                }

                // Arahkan tab ke URL target saat ini
                executionTab.location.href = currentUrl;

                // Tahap 1: Tunggu dokumen selesai loading
                await waitForLoad(executionTab);

                // Tahap 2: Tambahkan delay aman 5 detik agar server OJS benar-benar tuntas memproses backend data
                await sleep(5000);
            }

            // Semua URL sukses diproses, tutup tab eksekusi
            if (executionTab && !executionTab.closed) {
                executionTab.close();
            }

            showNotification(`Seluruh ${urls.length} URL berhasil diproses secara berurutan.`);

        } catch (error) {
            console.error(`Terjadi kegagalan sistem saat eksekusi:`, error);
            showNotification(`Terjadi kesalahan saat memproses rangkaian URL.`, true);
        } finally {
            // Kembalikan keadaan tombol seperti semula
            button.innerHTML = originalButtonHtml;
            button.disabled = false;
            if (btnCopy) btnCopy.disabled = false;
            isOpening = false;

            // Sembunyikan progress area setelah 3 detik jeda kosmetik
            setTimeout(() => {
                if (progressContainer) progressContainer.classList.add('hidden');
                if (progressBar) progressBar.style.width = `0%`;
            }, 3000);
        }
    }

    /**
     * Menyalin seluruh URL yang digenerate ke papan klip (clipboard)
     */
    function copyAllUrls() {
        if (urls.length === 0) {
            showNotification(`Tidak ada URL untuk disalin`, true);
            return;
        }

        const text = urls.join('\n');
        
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text)
                .then(() => {
                    showNotification(`Berhasil menyalin ${urls.length} URL ke clipboard`);
                })
                .catch(() => {
                    copyToClipboardFallback(text);
                });
        } else {
            copyToClipboardFallback(text);
        }
    }

    /**
     * Fallback sistem salin clipboard jika protokol navigator.clipboard diblokir browser
     */
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
            showNotification(`Gagal menyalin URL ke clipboard`, true);
        }
        
        document.body.removeChild(textarea);
    }

    // Shortcut Keyboard Global: Ctrl+Shift+O untuk trigger eksekusi sekuensial aman
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.shiftKey && (e.key === 'O' || e.key === 'o')) {
            e.preventDefault();
            const btnExecute = document.getElementById('btn-execute');
            if (btnExecute && !btnExecute.disabled) {
                openSequentially(btnExecute);
            }
        }
    });

    // Logging informasi awal list data URL ke console devtools secara rapi
    console.log(`Total URL yang digenerate: ${urls.length}`);
    console.log(`URL List:`, urls);
</script>
@endpush
@endsection