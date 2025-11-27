<div class="bg-white p-6 shadow rounded-lg">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Your Transactions</h2>

        <a href="{{ route('transactions.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
            + Add Transaction
        </a>
    </div>

    <!-- EMPTY -->
    @if ($transactions->isEmpty())
        <p class="text-gray-500">No transactions yet.</p>

    @else
        <table class="w-full border rounded-lg overflow-hidden">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="py-3 px-4 text-left">Type</th>
                    <th class="py-3 px-4 text-left">Category</th>
                    <th class="py-3 px-4 text-left">Amount</th>
                    <th class="py-3 px-4 text-left">Date</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($transactions as $t)
                <tr class="
                    border-b
                    @if($t->type === 'income') bg-green-100 @else bg-red-100 @endif
                    hover:bg-gray-200 transition
                ">
                    <td class="py-3 px-4 capitalize">{{ $t->type }}</td>
                    <td class="py-3 px-4">{{ $t->category }}</td>

                    <td class="py-3 px-4 font-semibold">
                        @if ($t->type === 'income')
                            <span class="text-green-700">+ ${{ number_format($t->amount, 2) }}</span>
                        @else
                            <span class="text-red-700">- ${{ number_format($t->amount, 2) }}</span>
                        @endif
                    </td>

                    <td class="py-3 px-4">{{ $t->date }}</td>

                    <td class="py-3 px-4 flex gap-2">

                        <!-- VIEW NOTES BUTTON -->
                        @if ($t->notes)
                            <button 
                                wire:click="openViewModal('{{ addslashes($t->notes) }}')"
                                class="px-3 py-1 bg-blue-500 text-white rounded shadow hover:bg-blue-600 transition">
                                View
                            </button>
                        @else
                            <span class="text-gray-400 px-3 py-1">—</span>
                        @endif

                        <!-- EDIT BUTTON -->
                        <a href="{{ route('transactions.edit', $t->id) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded shadow hover:bg-yellow-600 transition">
                            Edit
                        </a>

                        <!-- DELETE BUTTON -->
                        <button 
                            wire:click="openDeleteModal({{ $t->id }})"
                            class="px-3 py-1 bg-red-600 text-white rounded shadow hover:bg-red-700 transition">
                            Delete
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif


    <!-- ========================================================= -->
    <!--                     GLOBAL MODAL (NO JS)                  -->
    <!-- ========================================================= -->
    @if ($modalType)

        <!-- overlay -->
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

            <!-- modal box -->
            <div class="bg-white w-full max-w-md p-6 rounded shadow-xl">

                @if ($modalType === 'view')
                    <h3 class="text-xl font-semibold mb-4">Description</h3>

                    <p class="text-gray-700 whitespace-pre-line">
                        {{ $modalContent }}
                    </p>

                    <div class="mt-6 flex justify-end">
                        <button 
                            wire:click="closeModal"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                            Close
                        </button>
                    </div>
                @endif


                @if ($modalType === 'delete')
                    <h3 class="text-xl font-semibold text-red-700 mb-4">Confirm Delete</h3>

                    <p class="text-gray-700">Are you sure you want to delete this transaction?</p>

                    <div class="mt-6 flex justify-end gap-3">
                        <button 
                            wire:click="closeModal"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                            Cancel
                        </button>

                        <button 
                            wire:click="delete"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                            Yes, Delete
                        </button>
                    </div>
                @endif

            </div>
        </div>

    @endif

</div>
