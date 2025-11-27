<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold">Transactions</h2>

        <a href="{{ route('transactions.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
            + Add Transaction
        </a>
    </div>

    <!-- EMPTY STATE -->
    @if ($transactions->isEmpty())
        <div class="bg-white p-10 shadow rounded text-center text-gray-500">
            No transactions yet.
        </div>

    @else

        <!-- TRANSACTION CARDS -->
        <div class="space-y-4">

            @foreach ($transactions as $t)

                <div class="
                    flex justify-between items-center p-4 rounded-lg shadow bg-white
                    border-l-8 
                    {{ $t->type === 'income' ? 'border-green-500' : 'border-red-500' }}
                    hover:shadow-lg transition
                ">
                    <!-- LEFT SIDE -->
                    <div>
                        <p class="text-lg font-semibold">{{ $t->category }}</p>

                        <p class="text-sm text-gray-500">
                            {{ $t->date }}
                        </p>

                        @if ($t->notes)
                            <button wire:click="openNotes({{ $t->id }})"
                                    class="text-blue-600 text-sm underline mt-1">
                                View Notes
                            </button>
                        @endif
                    </div>

                    <!-- AMOUNT -->
                    <div class="text-right">
                        @if ($t->type === 'income')
                            <p class="text-green-600 text-xl font-bold">+${{ number_format($t->amount, 2) }}</p>
                        @else
                            <p class="text-red-600 text-xl font-bold">-${{ number_format($t->amount, 2) }}</p>
                        @endif

                        <!-- ACTION BUTTONS -->
                        <div class="flex gap-2 mt-3">

                            <a href="{{ route('transactions.edit', $t->id) }}"
                               class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 transition shadow">
                                Edit
                            </a>

                            <button wire:click="confirmDelete({{ $t->id }})"
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition shadow">
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
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                        Cancel
                    </button>

                    <button wire:click="deleteConfirmed"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Delete
                    </button>
                </div>

            </div>

        </div>
    @endif


    <!-- ========================= NOTES MODAL ========================= -->

    @if ($showNotes)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

            <div class="bg-white w-full max-w-md p-6 rounded shadow-xl">

                <h3 class="text-xl font-semibold mb-4">Notes</h3>

                <p class="text-gray-700 whitespace-pre-line">
                    {{ $noteContent }}
                </p>

                <div class="mt-6 flex justify-end">
                    <button wire:click="closeNotes"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Close
                    </button>
                </div>

            </div>

        </div>
    @endif

</div>
