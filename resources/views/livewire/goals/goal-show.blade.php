<div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">{{ $goal->name }}</h1>

        <button wire:click="deleteGoal"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
            Delete Goal
        </button>
    </div>

    <!-- Goal Summary -->
    <div class="bg-white p-6 rounded shadow mb-6">

        <p class="text-lg">
            Target:
            <strong>${{ number_format($goal->target_amount, 2) }}</strong>
        </p>

        <p class="text-lg mt-2">
            Saved:
            <strong class="@if($goal->isAchieved) text-green-600 @endif">
                ${{ number_format($goal->current_amount, 2) }}
            </strong>
        </p>

        @if ($goal->isAchieved)
            <div class="mt-4 p-3 rounded bg-green-100 text-green-700 font-semibold">
                ✔ Goal Achieved!
            </div>
        @endif
    </div>

    <!-- Add / Remove Money -->
    <div class="bg-white p-6 rounded shadow mb-8">

        <h3 class="text-xl font-semibold mb-4">Modify Goal</h3>

        <input type="number" wire:model="amount"
               class="w-full border rounded p-2 mb-3"
               placeholder="Enter amount">

        <textarea wire:model="notes"
                  class="w-full border rounded p-2 mb-3"
                  placeholder="Notes (optional)"></textarea>

        @error('amount')
            <p class="text-red-600">{{ $message }}</p>
        @enderror

        <div class="flex gap-3">

            <!-- Add -->
            <button wire:click="addToGoal"
                    @if($goal->isAchieved) disabled @endif
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 disabled:bg-gray-400">
                + Add
            </button>

            <!-- Remove -->
            <button wire:click="removeFromGoal"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                - Remove
            </button>
        </div>
    </div>

    <!-- History -->
    <div class="bg-white p-6 rounded shadow mb-8">

        <h3 class="text-xl font-semibold mb-4">Goal History</h3>

        @if ($goal->transactions->isEmpty())
            <p class="text-gray-500">No changes made yet.</p>
        @else
            <ul class="divide-y">

                @foreach ($goal->transactions as $gt)
                    <li class="py-3 flex justify-between">
                        <div>
                            <p class="font-semibold">
                                @if ($gt->type === 'add')
                                    <span class="text-green-600">+${{ number_format($gt->amount, 2) }}</span>
                                @else
                                    <span class="text-red-600">-${{ number_format($gt->amount, 2) }}</span>
                                @endif
                            </p>
                            <p class="text-sm text-gray-500">
                                {{ $gt->date }}
                            </p>
                        </div>

                        @if($gt->notes)
                            <div class="text-gray-600">
                                "{{ $gt->notes }}"
                            </div>
                        @endif
                    </li>
                @endforeach

            </ul>
        @endif

    </div>

</div>
