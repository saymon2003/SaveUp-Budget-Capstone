<?php

use App\Http\Middleware\EnsureEmailOtpVerified;
use App\Livewire\Dashboard;
use App\Livewire\Goals\GoalCreate;
use App\Livewire\Goals\GoalsIndex;
use App\Livewire\Goals\GoalShow;
use App\Livewire\Transactions\TransactionForm;
use App\Livewire\Transactions\TransactionsIndex;
use App\Mail\LoginVerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified', EnsureEmailOtpVerified::class])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/transactions', TransactionsIndex::class)->name('transactions.index');
    Route::get('/transactions/create', TransactionForm::class)->name('transactions.create');
    Route::get('/transactions/{id}/edit', TransactionForm::class)->name('transactions.edit');

    Route::get('/goals', GoalsIndex::class)->name('goals.index');
    Route::get('/goals/create', GoalCreate::class)->name('goals.create');
    Route::get('/goals/{id}', GoalShow::class)->name('goals.show');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/login-code', function () {
        return view('auth.login-code');
    })->name('otp.notice');

    Route::post('/login-code', function (Request $request) {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = $request->user();

        if (! $user->email_login_code || ! $user->email_login_code_expires_at) {
            return back()->withErrors(['code' => 'No verification code found. Please resend a new one.']);
        }

        if (now()->greaterThan($user->email_login_code_expires_at)) {
            return back()->withErrors(['code' => 'This code has expired. Please resend a new one.']);
        }

        if (! Hash::check($request->code, $user->email_login_code)) {
            return back()->withErrors(['code' => 'The verification code is incorrect.']);
        }

        $user->forceFill([
            'email_login_code' => null,
            'email_login_code_expires_at' => null,
        ])->save();

        session(['email_2fa_passed' => true]);

        return redirect()->route('dashboard');
    })->name('otp.verify');

    Route::post('/login-code/resend', function (Request $request) {
        $user = $request->user();

        $code = (string) random_int(100000, 999999);

        $user->forceFill([
            'email_login_code' => Hash::make($code),
            'email_login_code_expires_at' => now()->addMinutes(10),
        ])->save();

        Mail::to($user->email)->send(new LoginVerificationCodeMail($user->name, $code));

        return back()->with('status', 'A new code has been sent to your email.');
    })->name('otp.resend');
});

require __DIR__.'/auth.php';