<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Dashboard
use App\Livewire\Dashboard;

// Transactions
use App\Livewire\Transactions\TransactionsIndex;
use App\Livewire\Transactions\TransactionForm;

// Goals
use App\Livewire\Goals\GoalsIndex;
use App\Livewire\Goals\GoalShow;
use App\Livewire\Goals\GoalCreate;

// Welcome Page (public)
Route::get('/', function () {
    return view('welcome');
});

// ===============================================
// PROTECTED ROUTES (LOGIN REQUIRED)
// ===============================================

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ------------------------
    // TRANSACTIONS
    // ------------------------
    Route::get('/transactions', TransactionsIndex::class)->name('transactions.index');
    Route::get('/transactions/create', TransactionForm::class)->name('transactions.create');
    Route::get('/transactions/{id}/edit', TransactionForm::class)->name('transactions.edit');

    // ------------------------
    // GOALS
    // ------------------------
    Route::get('/goals', GoalsIndex::class)->name('goals.index');
    Route::get('/goals/create', GoalCreate::class)->name('goals.create');
    Route::get('/goals/{id}', GoalShow::class)->name('goals.show');
});

Route::middleware(['throttle:5,1'])->group(function () {
    require __DIR__.'/auth.php';
});