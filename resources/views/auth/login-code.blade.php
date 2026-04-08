<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Login Code - SaveUp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-6 font-sans">

    <div class="w-full max-w-lg">
        <div class="overflow-hidden rounded-[30px] border border-slate-200 bg-white shadow-[0_20px_60px_rgba(15,23,42,0.12)]">
            <div class="bg-gradient-to-r from-blue-950 via-blue-700 to-sky-500 px-8 py-8 text-center text-white">
                <h1 class="text-4xl font-extrabold tracking-tight">SaveUp Security</h1>
                <p class="mt-3 text-base text-blue-100">
                    Enter the 6-digit code sent to your email
                </p>
            </div>

            <div class="p-8">
                @if (session('status'))
                    <div class="mb-5 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('otp.verify') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Verification Code
                        </label>

                        <input
                            type="text"
                            name="code"
                            maxlength="6"
                            inputmode="numeric"
                            autocomplete="one-time-code"
                            class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-5 py-4 text-center text-3xl font-extrabold tracking-[0.45em] text-slate-900 shadow-sm transition focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                            placeholder="000000"
                            required
                        >

                        @error('code')
                            <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-gradient-to-r from-blue-900 via-blue-700 to-sky-500 px-6 py-3.5 text-lg font-bold text-white shadow-lg transition hover:from-blue-950 hover:to-sky-600"
                    >
                        Verify and Continue
                    </button>
                </form>

                <form method="POST" action="{{ route('otp.resend') }}" class="mt-4">
                    @csrf
                    <button
                        type="submit"
                        class="w-full rounded-2xl border border-slate-300 bg-slate-100 px-6 py-3.5 text-base font-semibold text-slate-700 transition hover:bg-slate-200"
                    >
                        Resend Code
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>