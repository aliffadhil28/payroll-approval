<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PageController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/payroll_request', [PageController::class, 'payroll_request'])->name('payroll_request');
    Route::post('/payroll_request', [PageController::class, 'add_payroll_request'])->name('payroll_request.store');
    Route::post('/payroll_request/approve/{id}', [PageController::class, 'approve_payroll_request'])->name('payroll_request.approve');
    Route::post('/payroll_request/reject/{id}', [PageController::class, 'reject_payroll_request'])->name('payroll_request.reject');
    Route::post('/payroll_request/process/{id}', [PageController::class, 'process_payroll_request'])->name('payroll_request.process');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
