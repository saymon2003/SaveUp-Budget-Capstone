<div class="max-w-md mx-auto mt-10 bg-white p-6 shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Set Your Starting Balance</h2>

    <p class="text-gray-600 mb-4">
        Please enter the amount of money you currently have.
    </p>

    <form wire:submit.prevent="save" class="space-y-4">

        <div>
            <label class="font-semibold">Starting Balance</label>
            <input type="number" step="0.01"
                   wire:model="balance"
                   class="w-full border rounded p-2">
            @error('balance') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Save
        </button>

    </form>
</div>
