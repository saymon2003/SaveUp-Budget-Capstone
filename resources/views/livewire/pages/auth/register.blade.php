<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('verification.notice'));
    }
};
?>

<div>
    <div class="mb-8 text-center">
        <h2 class="text-4xl font-extrabold tracking-tight text-slate-900">
            Create Account
        </h2>
        <p class="mt-3 text-base text-slate-500">
            Start managing your finances with SaveUp
        </p>
    </div>

    <form wire:submit.prevent="register" class="space-y-5">
        <div>
            <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                Full Name
            </label>
            <input
                wire:model="name"
                id="name"
                type="text"
                name="name"
                required
                autofocus
                autocomplete="name"
                class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base text-slate-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                placeholder="Enter your full name"
            >
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">
                Email
            </label>
            <input
                wire:model="email"
                id="email"
                type="email"
                name="email"
                required
                autocomplete="username"
                class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base text-slate-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                placeholder="Enter your email"
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
                Password
            </label>
            <input
                wire:model="password"
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base text-slate-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                placeholder="Create a password"
            >
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">
                Confirm Password
            </label>
            <input
                wire:model="password_confirmation"
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base text-slate-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                placeholder="Confirm your password"
            >
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button
            type="submit"
            class="w-full rounded-2xl bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 px-6 py-3.5 text-lg font-bold text-white shadow-lg transition hover:scale-[1.01] hover:from-blue-950 hover:to-sky-600"
        >
            Register
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Already registered?
        <a href="{{ route('login') }}" wire:navigate class="font-semibold text-blue-700 hover:text-blue-800">
            Sign in
        </a>
    </p>
</div>