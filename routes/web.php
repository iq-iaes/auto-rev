<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AutomationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Journal Management Routes
    Route::resource('journals', JournalController::class);
    Route::post('/journals/{journal}/toggle-status', [JournalController::class, 'toggleStatus'])
        ->name('journals.toggle-status');

    // Automation Routes
    Route::get('/automation', [AutomationController::class, 'index'])->name('automation.index');
    Route::post('/automation/execute', [AutomationController::class, 'execute'])->name('automation.execute');
    Route::get('/automation/jobs/{job}', [AutomationController::class, 'show'])->name('automation.show');
    Route::get('/automation/jobs/{job}/export', [AutomationController::class, 'export'])->name('automation.export');

    // Log Routes
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::get('/logs/export', [LogController::class, 'export'])->name('logs.export');
});

require __DIR__.'/auth.php';