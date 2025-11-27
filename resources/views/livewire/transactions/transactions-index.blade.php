<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Your Transactions</h2>

        <a href="{{ route('transactions.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Add Transaction
        </a>
    </div>

    <table class="min-w-full bg-white shadow-md rounded border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Type</th>
                <th class="px-4 py-2 text-left">Category</th>
                <th class="px-4 py-2 text-left">Amount</th>
                <th class="px-4 py-2 text-left">Date</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($transactions as $t)
                <tr class="border-b">
                    <td class="px-4 py-2 capitalize">{{ $t->type }}</td>
                    <td class="px-4 py-2">{{ $t->category }}</td>
                    <td class="px-4 py-2">${{ number_format($t->amount, 2) }}</td>
                    <td class="px-4 py-2">{{ $t->date }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('transactions.edit', $t->id) }}"
                           class="text-blue-600 hover:underline mr-3">Edit</a>

                        <button wire:click="delete({{ $t->id }})"
                                class="text-red-600 hover:underline">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                        No transactions found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
