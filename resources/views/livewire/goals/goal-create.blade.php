<x-app-layout>

    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

        <h1 class="text-2xl font-bold mb-4">Create a New Goal</h1>

        <form wire:submit.prevent="save" class="space-y-4">

            <!-- Name -->
            <div>
                <label class="font-semibold block mb-1">Goal Name</label>
                <input type="text" wire:model="name" class="w-full border rounded p-2">
                @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Target Amount -->
            <div>
                <label class="font-semibold block mb-1">Target Amount</label>
                <input type="number" wire:model="target_amount" step="0.01" class="w-full border rounded p-2">
                @error('target_amount') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Deadline -->
            <div>
                <label class="font-semibold block mb-1">Deadline (optional)</label>
                <input type="date" wire:model="deadline" class="w-full border rounded p-2">
                @error('deadline') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Notes -->
            <div>
                <label class="font-semibold block mb-1">Notes (optional)</label>
                <textarea wire:model="notes" class="w-full border rounded p-2"></textarea>
                @error('notes') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-between mt-4">
                <a href="{{ route('goals.index') }}"
                   class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                    Cancel
                </a>

                <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
                    Save Goal
                </button>
            </div>

        </form>

    </div>

</x-app-layout>
