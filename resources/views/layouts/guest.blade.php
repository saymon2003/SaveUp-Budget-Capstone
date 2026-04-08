<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SaveUp') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased">
    <div class="min-h-screen flex">
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-950 via-blue-800 to-sky-500 text-white p-14 flex-col justify-between">
            <div>
                <div class="h-16 w-16 rounded-2xl bg-white/15 backdrop-blur flex items-center justify-center text-2xl font-extrabold shadow-lg">
                    S
                </div>

                <h1 class="mt-8 text-5xl font-extrabold tracking-tight leading-tight">
                    SaveUp
                </h1>

                <p class="mt-5 max-w-xl text-lg text-blue-100/90 leading-relaxed">
                    Smart personal finance management with secure login, email verification,
                    and a beautiful dashboard for tracking goals, balances, and transactions.
                </p>
            </div>

            <div class="text-sm text-blue-100/80">
                Personal Finance Dashboard
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 md:p-10">
            <div class="w-full max-w-md">
                <div class="mb-8 text-center lg:hidden">
                    <div class="mx-auto h-16 w-16 rounded-2xl bg-gradient-to-br from-blue-900 to-sky-500 text-white flex items-center justify-center text-2xl font-extrabold shadow-xl">
                        S
                    </div>
                    <h1 class="mt-4 text-3xl font-extrabold text-slate-900">SaveUp</h1>
                    <p class="mt-2 text-slate-500">Secure access to your finance dashboard</p>
                </div>

                <div class="rounded-[28px] border border-slate-200 bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.12)]">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>