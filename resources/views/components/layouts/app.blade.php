<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'SaveUp' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-slate-100 text-slate-900">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-72 bg-gradient-to-b from-blue-950 via-blue-900 to-slate-950 text-white flex flex-col shadow-2xl">

            <div class="px-7 py-8 border-b border-white/10">
                <h1 class="text-3xl font-extrabold tracking-tight text-white">SaveUp</h1>
                <p class="mt-2 text-sm text-blue-100/80">Personal Finance Dashboard</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-3">
                <a href="{{ route('dashboard') }}"
                   class="block rounded-2xl px-5 py-3.5 text-base font-bold transition
                   {{ request()->routeIs('dashboard') ? 'bg-white text-blue-900 shadow-lg' : 'text-white/90 hover:bg-white/10 hover:text-white' }}">
                    Dashboard
                </a>

                <a href="{{ route('transactions.index') }}"
                   class="block rounded-2xl px-5 py-3.5 text-base font-bold transition
                   {{ request()->routeIs('transactions.*') ? 'bg-white text-blue-900 shadow-lg' : 'text-white/90 hover:bg-white/10 hover:text-white' }}">
                    Transactions
                </a>

                <a href="{{ route('goals.index') }}"
                   class="block rounded-2xl px-5 py-3.5 text-base font-bold transition
                   {{ request()->routeIs('goals.*') ? 'bg-white text-blue-900 shadow-lg' : 'text-white/90 hover:bg-white/10 hover:text-white' }}">
                    Goals
                </a>

                <a href="{{ route('profile') }}"
                   class="block rounded-2xl px-5 py-3.5 text-base font-bold transition
                   {{ request()->routeIs('profile') ? 'bg-white text-blue-900 shadow-lg' : 'text-white/90 hover:bg-white/10 hover:text-white' }}">
                    Profile
                </a>
            </nav>

            <div class="px-4 pb-5 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full rounded-2xl bg-red-600 px-4 py-3.5 text-base font-bold text-white shadow-lg transition hover:bg-red-700">
                        Log Out
                    </button>
                </form>
            </div>

        </aside>

        <!-- Main -->
        <div class="flex-1 flex flex-col min-w-0">

            <header class="bg-white border-b border-slate-200 px-10 py-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-slate-900">
                            {{ $title ?? 'Dashboard' }}
                        </h2>
                        <p class="mt-1.5 text-base text-slate-500">
                            Welcome back, {{ auth()->user()->name }}
                        </p>
                    </div>

                    <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-blue-800 to-sky-500 text-white flex items-center justify-center text-lg font-extrabold shadow-lg">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                </div>
            </header>

            <main class="flex-1 p-10">
                <div class="max-w-6xl mx-auto">
                    {{ $slot }}
                </div>
            </main>

        </div>

    </div>

    @livewireScripts
</body>
</html>