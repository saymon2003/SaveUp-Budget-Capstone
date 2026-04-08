<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {};
?>

<div class="space-y-4 text-center">
    <h2 class="text-2xl font-semibold">Verify your email</h2>

    <p class="text-sm text-gray-600">
        We sent you a verification link. Click the link in the email to activate your account.
    </p>

    @if (session('status') === 'verification-link-sent')
        <p class="text-sm text-green-600">
            A new verification email has been sent.
        </p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="space-y-3">
        @csrf
        <button type="submit" class="w-full rounded bg-blue-600 px-4 py-2 text-white">
            Resend verification email
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-red-500 underline">
            Log out
        </button>
    </form>
</div>