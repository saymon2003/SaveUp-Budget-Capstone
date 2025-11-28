
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

        <h2 class="text-2xl font-bold mb-6">Create New Goal</h2>

        <form wire:submit.prevent="save" class="space-y-4">

            <div>
                <label class="block font-semibold">Goal Name</label>
                <input type="text" wire:model="name" class="w-full border rounded p-2">
                @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Target Amount</label>
                <input type="number" wire:model="target_amount" step="0.01" class="w-full border rounded p-2">
                @error('target_amount') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Deadline (Optional)</label>
                <input type="date" wire:model="deadline" class="w-full border rounded p-2">
                @error('deadline') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Notes (Optional)</label>
                <textarea wire:model="notes" class="w-full border rounded p-2"></textarea>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('goals.index') }}"
                   class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition">
                    ← Back
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 shadow transition">
                    Save Goal
                </button>
            </div>

        </form>

    </div>


