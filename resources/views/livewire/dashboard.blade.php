<div class="max-w-3xl mx-auto">

    <!-- ========================= GREETING BANNER ========================= -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-8 rounded-xl shadow mb-8 text-center">
        <h1 class="text-3xl font-bold">
            Hello, {{ auth()->user()->name }} 👋
        </h1>
        <p class="text-white/90 mt-2">
            Welcome back to your SaveUp dashboard!
        </p>
    </div>


    {{-- ========================= SET INITIAL BALANCE ========================= --}}
    @if ($balance === null)

        <div class="bg-white shadow rounded p-8 text-center">

            <h2 class="text-2xl font-bold mb-4">Set Your Starting Balance</h2>

            <p class="text-gray-600 mb-6">
                Before using SaveUp, please enter the amount you currently have.
            </p>

            <form wire:submit.prevent="saveInitialBalance" class="space-y-4 max-w-sm mx-auto">

                <input type="number" wire:model="balance"
                    class="w-full border rounded p-3 text-center"
                    placeholder="Enter your balance">

                @error('balance')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition w-full">
                    Save Balance
                </button>

            </form>
        </div>

    @else

        {{-- ========================= CURRENT BALANCE CARD ========================= --}}
        <div class="bg-white shadow rounded p-8 text-center mb-8">

            <h2 class="text-2xl font-bold mb-2">Current Balance</h2>

            <p class="text-4xl font-bold text-green-600 mb-6">
                ${{ number_format($balance, 2) }}
            </p>

            <div class="flex justify-center gap-4">
                <a href="{{ route('transactions.create') }}"
                    class="px-5 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700 transition">
                    + Add Income
                </a>

                <a href="{{ route('transactions.create') }}?expense=1"
                    class="px-5 py-2 bg-red-600 text-white rounded shadow hover:bg-red-700 transition">
                    - Add Expense
                </a>
            </div>

        </div>

        {{-- ========================= RECENT GOALS ========================= --}}
        <div class="bg-white shadow rounded p-8 text-center mb-8">

            <h2 class="text-xl font-bold mb-4">Your Goals</h2>

            @if ($recentGoals->isEmpty())
                <p class="text-gray-500">No goals created yet.</p>

                <a href="{{ route('goals.create') }}"
                    class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Create a Goal
                </a>
            @else
                <div class="space-y-4">

                    @foreach ($recentGoals as $g)
                        <a href="{{ route('goals.show', $g->id) }}"
                            class="block bg-gray-50 border rounded p-4 hover:bg-gray-100 transition">

                            <div class="font-semibold text-lg">
                                {{ $g->name }}
                            </div>

                            <div class="text-sm text-gray-700">
                                Saved: ${{ number_format($g->current_amount, 2) }}
                                /
                                ${{ number_format($g->target_amount, 2) }}
                            </div>

                            @if ($g->isAchieved)
                                <div class="mt-2 text-green-600 font-semibold">
                                    ✔ Goal Achieved
                                </div>
                            @endif
                        </a>
                    @endforeach

                    <a href="{{ route('goals.index') }}"
                        class="block text-blue-600 hover:underline mt-4">
                        View All Goals →
                    </a>

                </div>
            @endif
        </div>

        {{-- ========================= RECENT TRANSACTIONS ========================= --}}
        <div class="bg-white shadow rounded p-8 text-center">

            <h2 class="text-xl font-bold mb-4">Recent Transactions</h2>

            @if ($recentTransactions->isEmpty())
                <p class="text-gray-500">No recent transactions.</p>
            @else
                <ul class="divide-y text-left">

                    @foreach ($recentTransactions as $t)
                        <li class="py-3 flex justify-between">
                            <div>
                                <p class="font-semibold">{{ $t->category }}</p>
                                <p class="text-sm text-gray-600">{{ $t->date }}</p>
                            </div>

                            <div class="font-bold">
                                @if ($t->type === 'income')
                                    <span class="text-green-600">+${{ number_format($t->amount, 2) }}</span>
                                @else
                                    <span class="text-red-600">-${{ number_format($t->amount, 2) }}</span>
                                @endif
                            </div>
                        </li>
                    @endforeach

                </ul>

                <a href="{{ route('transactions.index') }}"
                    class="block text-blue-600 hover:underline mt-4">
                    View All Transactions →
                </a>

            @endif
        </div>

    @endif
</div>
