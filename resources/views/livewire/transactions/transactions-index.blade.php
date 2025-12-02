<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Transactions</h1>

        <a href="{{ route('transactions.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Add Transaction
        </a>
    </div>

    @if ($transactions->isEmpty())
        <div class="bg-white p-6 rounded shadow text-center text-gray-600">
            No transactions yet.
        </div>
    @else

        <div class="space-y-4">

            @foreach ($transactions as $t)
                <div class="
                    flex justify-between items-center p-4 rounded shadow
                    border-l-8
                    @if($t->type === 'income')
                        bg-green-50 border-green-600
                    @else
                        bg-red-50 border-red-600
                    @endif
                ">
                    <!-- LEFT SIDE -->
                    <div>
                        <p class="font-semibold text-lg">
                            {{ $t->category }}
                        </p>
                        <p class="text-gray-600 text-sm">
                            {{ $t->date }}
                        </p>
                        @if ($t->notes)
                            <p class="text-gray-500 text-sm mt-1">
                                {{ $t->notes }}
                            </p>
                        @endif
                    </div>

                    <!-- RIGHT SIDE AMOUNT -->
                    <div class="text-right">
                        <p class="font-bold text-xl
                            @if($t->type === 'income') text-green-700 @else text-red-700 @endif
                        ">
                            @if ($t->type === 'income')
                                +${{ number_format($t->amount, 2) }}
                            @else
                                -${{ number_format($t->amount, 2) }}
                            @endif
                        </p>

                        <div class="mt-2 flex gap-2 justify-end">

                            <a href="{{ route('transactions.edit', $t->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                Edit
                            </a>

                            <button
                                wire:click="confirmDelete({{ $t->id }})"
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                Delete
                            </button>

                        </div>
                    </div>

                </div>
            @endforeach

        </div>

    @endif


    <!-- ========================= DELETE MODAL ========================= -->
    @if ($deleteId)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

            <div class="bg-white w-full max-w-md p-6 rounded shadow-xl">

                <h3 class="text-xl font-semibold mb-4">Confirm Delete</h3>

                <p class="text-gray-700 mb-6">
                    Are you sure you want to delete this transaction?
                </p>

                <div class="flex justify-end gap-3">

                    <button wire:click="cancelDelete"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Cancel
                    </button>

                    <button wire:click="delete"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Delete
                    </button>

                </div>

            </div>

        </div>
    @endif

</div>
