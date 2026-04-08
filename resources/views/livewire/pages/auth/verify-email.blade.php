<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {};
?>

<div>
    <div class="mb-8 text-center">
        <h2 class="text-4xl font-extrabold tracking-tight text-slate-900">
            Verify Your Email
        </h2>
        <p class="mt-3 text-base text-slate-500 leading-relaxed">
            We sent you a verification link. Click the link in your email to activate your account.
        </p>
    </div>

    @if (session('status') === 'verification-link-sent')
        <div class="mb-5 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
            A new verification email has been sent.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
        @csrf
        <button
            type="submit"
            class="w-full rounded-2xl bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 px-6 py-3.5 text-lg font-bold text-white shadow-lg transition hover:scale-[1.01] hover:from-blue-950 hover:to-sky-600"
        >
            Resend Verification Email
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button
            type="submit"
            class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-6 py-3.5 text-base font-semibold text-slate-700 transition hover:bg-slate-200"
        >
            Log Out
        </button>
    </form>
</div>