<div class="p-6 shadow rounded-lg max-w-xl mx-auto bg-white">

    <h2 class="text-2xl font-bold mb-6">
        {{ $transactionId ? 'Edit Transaction' : 'Add Transaction' }}
    </h2>

    <form wire:submit.prevent="save" class="space-y-5">

        {{-- TYPE --}}
        <div>
            <label class="block font-semibold mb-1">
                Type <span class="text-red-600">*</span>
            </label>

            <select wire:model.live="type"
                    class="w-full border rounded p-2">
                <option value="">Select Type</option>
                <option value="income">Income</option>
                <option value="expense">Expense</option>
            </select>

            @error('type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- CATEGORY --}}
        <div>
            <label class="block font-semibold mb-1">
                Category <span class="text-red-600">*</span>
            </label>

            <select wire:model.live="category"
                    class="w-full border rounded p-2"
                    {{ $type === '' ? 'disabled' : '' }}>

                <option value="">Select Category</option>

                @if ($type === 'income')
                    @foreach ($incomeCategories as $c)
                        <option value="{{ $c }}">{{ $c }}</option>
                    @endforeach
                @endif

                @if ($type === 'expense')
                    @foreach ($expenseCategories as $c)
                        <option value="{{ $c }}">{{ $c }}</option>
                    @endforeach
                @endif
            </select>

            @error('category') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- AMOUNT --}}
        <div>
            <label class="block font-semibold mb-1">
                Amount <span class="text-red-600">*</span>
            </label>

            <input type="number" wire:model.live="amount" class="w-full border rounded p-2" />
            @error('amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- DATE --}}
        <div>
            <label class="block font-semibold mb-1">
                Date <span class="text-red-600">*</span>
            </label>

            <input type="date" wire:model.live="date" class="w-full border rounded p-2" />
            @error('date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- NOTES --}}
        <div>
            <label class="block font-semibold mb-1">Notes (optional)</label>
            <textarea wire:model.live="notes" class="w-full border rounded p-2"></textarea>
        </div>

        {{-- BUTTONS --}}
        <div class="flex justify-between items-center pt-4 gap-4">

            <a href="{{ route('transactions.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 shadow-sm transition">
                ← Back
            </a>

            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
                {{ $transactionId ? 'Update Transaction' : 'Save Transaction' }}
            </button>

        </div>

    </form>
</div>
