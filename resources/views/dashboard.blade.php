<x-app-layout>

    <div class="max-w-5xl mx-auto space-y-8">

        <!-- HEADER -->
        <div class="bg-blue-600 text-white p-6 rounded-xl text-center">
            <h1 class="text-2xl font-bold">
                Welcome {{ auth()->user()->name }} 👋
            </h1>
        </div>

        <!-- BALANCE -->
        <div class="bg-white shadow p-6 rounded-xl text-center">
            <h2 class="text-xl font-bold mb-2">Balance</h2>

            @php
                $balance = auth()->user()->transactions->sum('amount');
            @endphp

            <p class="text-2xl font-bold text-green-600">
                ${{ $balance }}
            </p>
        </div>

        <!-- GOALS -->
        <div class="bg-white shadow p-6 rounded-xl">
            <h2 class="text-xl font-bold mb-4 text-center">Goals</h2>

            @forelse(auth()->user()->goals as $goal)
                <div class="border p-3 mb-2 rounded">
                    {{ $goal->name }} - ${{ $goal->target_amount }}
                </div>
            @empty
                <p class="text-center text-gray-500">No goals yet</p>
            @endforelse
        </div>

        <!-- TRANSACTIONS -->
        <div class="bg-white shadow p-6 rounded-xl">
            <h2 class="text-xl font-bold mb-4 text-center">Recent Transactions</h2>

            @forelse(auth()->user()->transactions as $t)
                <div class="border p-3 mb-2 rounded">
                    ${{ $t->amount }} - {{ $t->description }}
                </div>
            @empty
                <p class="text-center text-gray-500">No transactions yet</p>
            @endforelse
        </div>

    </div>

</x-app-layout>