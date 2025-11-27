<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @livewireStyles
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'SaveUp' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

<div class="flex min-h-screen">

    <!-- ======================= SIDEBAR ======================= -->
    <aside class="w-64 bg-gray-900 text-gray-200 flex flex-col">

        <!-- Logo -->
        <div class="p-6 text-2xl font-bold text-white">
            SaveUp
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 space-y-2">

            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 rounded 
                      {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }}">
                Dashboard
            </a>

            <a href="{{ route('transactions.index') }}"
               class="block px-4 py-2 rounded 
                      {{ request()->routeIs('transactions.*') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700' }}">
                Transactions
            </a>

            <a href="#"
               class="block px-4 py-2 rounded hover:bg-gray-700">
                Goals (coming soon)
            </a>

            <a href="{{ route('profile.edit') }}"
               class="block px-4 py-2 rounded hover:bg-gray-700">
                Profile
            </a>

        </nav>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="p-4">
            @csrf
            <button class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700">
                Log Out
            </button>
        </form>

    </aside>

    <!-- ======================= MAIN CONTENT ======================= -->
    <main class="flex-1 p-8">
        {{ $slot }}
    </main>

</div>

@livewireScripts
</body>
</html>
