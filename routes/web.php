<?php

use App\Livewire\Dashboard;
use App\Livewire\Goals\GoalCreate;
use App\Livewire\Goals\GoalsIndex;
use App\Livewire\Goals\GoalShow;
use App\Livewire\Transactions\TransactionForm;
use App\Livewire\Transactions\TransactionsIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');

/*
|--------------------------------------------------------------------------
| Transactions
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/transactions', TransactionsIndex::class)
        ->name('transactions.index');

    Route::get('/transactions/create', TransactionForm::class)
        ->name('transactions.create');

    Route::get('/transactions/{id}/edit', TransactionForm::class)
        ->name('transactions.edit');
});

/*
|--------------------------------------------------------------------------
| Goals
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/goals', GoalsIndex::class)
        ->name('goals.index');

    Route::get('/goals/create', GoalCreate::class)
        ->name('goals.create');

    Route::get('/goals/{id}', GoalShow::class)
        ->name('goals.show');
});

require __DIR__.'/auth.php';