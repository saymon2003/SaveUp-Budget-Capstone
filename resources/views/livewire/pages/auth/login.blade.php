<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {};
?>

<div>
    <div class="mb-8 text-center">
        <h2 class="text-4xl font-extrabold tracking-tight text-slate-900">
            Welcome Back
        </h2>
        <p class="mt-3 text-base text-slate-500">
            Sign in to access your SaveUp dashboard
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                Email
            </label>
            <input
                id="email"
                type="email"
                name="email"
                required
                autofocus
                class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base text-slate-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                placeholder="Enter your email"
            >
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
                Password
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base text-slate-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                placeholder="Enter your password"
            >
        </div>

        <button
            type="submit"
            class="w-full rounded-2xl bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 px-6 py-3.5 text-lg font-bold text-white shadow-lg transition hover:scale-[1.01] hover:from-blue-950 hover:to-sky-600"
        >
            Log In
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Don’t have an account?
        <a href="{{ route('register') }}" wire:navigate class="font-semibold text-blue-700 hover:text-blue-800">
            Create one
        </a>
    </p>
</div>