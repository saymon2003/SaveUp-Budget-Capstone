<div>

    {{-- Setup first-time balance --}}
    @if ($balance === null)

        <div class="bg-white shadow rounded p-6 max-w-xl">

            <h2 class="text-xl font-bold mb-4">Set Your Starting Balance</h2>

            <form wire:submit.prevent="saveInitialBalance" class="space-y-4">

                <input type="number" wire:model="balance"
                       class="w-full border rounded p-2"
                       placeholder="Enter your current balance">

                @error('balance')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror

                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition shadow">
                    Save Balance
                </button>

            </form>

        </div>

    @else

        <!-- Balance Box -->
        <div class="bg-white shadow rounded p-6 mb-6 max-w-2xl">

            <h2 class="text-2xl font-bold">Current Balance</h2>

            <p class="text-4xl font-bold text-green-600 mt-2">
                ${{ number_format($balance, 2) }}
            </p>

            <div class="flex gap-4 mt-6">

                <a href="{{ route('transactions.create') }}"
                   class="px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700 transition">
                    + Add Income
                </a>

                <a href="{{ route('transactions.create') }}?expense=1"
                   class="px-4 py-2 bg-red-600 text-white rounded shadow hover:bg-red-700 transition">
                    - Add Expense
                </a>

            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white shadow rounded p-6 max-w-2xl">

            <h3 class="text-xl font-bold mb-4">Recent Transactions</h3>

            @if ($recentTransactions->isEmpty())
                <p class="text-gray-500">No recent activity.</p>
            @else
                <ul class="divide-y">
                    @foreach ($recentTransactions as $t)
                        <li class="py-4 flex justify-between">
                            <div>
                                <p class="font-semibold">{{ $t->category }}</p>
                                <p class="text-sm text-gray-500">{{ $t->date }}</p>
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
            @endif

            <a href="{{ route('transactions.index') }}"
               class="block text-center mt-4 text-blue-600 hover:underline">
                View All Transactions →
            </a>

        </div>

    @endif
    {{-- ========================= RECENT GOALS ========================= --}}
<div class="bg-white shadow rounded p-6 mt-6">
    <h3 class="text-xl font-bold mb-4">Recent Goals</h3>

    @if ($recentGoals->isEmpty())
        <p class="text-gray-500">No goals created yet.</p>
    @else
        <ul class="divide-y">
            @foreach ($recentGoals as $g)
                <li class="py-3 flex justify-between items-center">

                    <div>
                        <p class="font-semibold">{{ $g->name }}</p>
                        <p class="text-sm text-gray-600">
                            {{ number_format($g->current_amount, 2) }} / 
                            {{ number_format($g->target_amount, 2) }}
                        </p>
                    </div>

                    <a href="{{ route('goals.show', $g->id) }}"
                       class="text-blue-600 hover:underline">
                        View →
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('goals.index') }}"
       class="block text-center mt-4 text-blue-600 hover:underline">
        See All Goals →
    </a>
</div>


</div>
