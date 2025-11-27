<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Livewire components
use App\Livewire\Transactions\TransactionsIndex;
use App\Livewire\Transactions\TransactionForm;

// -------------------------------------------
// Public Routes
// -------------------------------------------

// Home Page
Route::get('/', function () {
    return view('welcome');
});

// -------------------------------------------
// Protected Routes (User Must Be Logged In)
// -------------------------------------------

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // -------------------------------------------
    // Transactions (Livewire page components)
    // -------------------------------------------

    Route::get('/transactions', TransactionsIndex::class)
        ->name('transactions.index');

    Route::get('/transactions/create', TransactionForm::class)
        ->name('transactions.create');

    // IMPORTANT: Livewire expects parameter BEFORE edit
    Route::get('/transactions/{id}/edit', TransactionForm::class)
        ->name('transactions.edit');
});

// -------------------------------------------
// Test Route (not protected)
// -------------------------------------------

Route::get('/test', function () {
    return view('test');
});

require __DIR__.'/auth.php';
