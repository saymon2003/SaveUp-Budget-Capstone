
    <div class="max-w-3xl mx-auto space-y-6">

        <!-- ========================= GOAL HEADER ========================= -->
        <div class="bg-white p-6 rounded-lg shadow">

            <h2 class="text-2xl font-bold mb-2">
                🎯 {{ $goal->name }}
            </h2>

            <p class="text-gray-600 mb-4">
                Target: <span class="font-semibold">${{ number_format($goal->target_amount, 2) }}</span><br>
                Deadline: 
                <span class="font-semibold">
                    {{ $goal->deadline ? $goal->deadline : 'No deadline' }}
                </span>
            </p>

            @php
                $progress = ($goal->current_amount / $goal->target_amount) * 100;
                $progress = $progress > 100 ? 100 : $progress;
            @endphp

            <!-- PROGRESS BAR -->
            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                <div class="bg-green-500 h-4" style="width: {{ $progress }}%;"></div>
            </div>

            <p class="mt-2 text-gray-700">
                <span class="font-bold">${{ number_format($goal->current_amount, 2) }}</span> saved —
                <span class="font-bold">{{ number_format($progress, 1) }}%</span> complete
            </p>
        </div>


        <!-- ========================= ADD / REMOVE MONEY ========================= -->
        <div class="bg-white p-6 rounded-lg shadow">

            <h3 class="text-xl font-semibold mb-4">Update Goal</h3>

            <form wire:submit.prevent="addToGoal" class="mb-6">
                <label class="block font-semibold mb-1">Amount to Add</label>
                <input type="number" wire:model="amount" step="0.01"
                       class="border rounded p-2 w-full mb-2">

                <label class="block font-semibold mb-1">Notes (optional)</label>
                <textarea wire:model="notes" class="border rounded p-2 w-full mb-4"></textarea>

                @error('amount')
                    <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="px-5 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700 transition">
                    + Add to Goal
                </button>
            </form>

            <form wire:submit.prevent="removeFromGoal">
                <label class="block font-semibold mb-1">Amount to Remove</label>
                <input type="number" wire:model="amount" step="0.01"
                       class="border rounded p-2 w-full mb-2">

                <label class="block font-semibold mb-1">Notes (optional)</label>
                <textarea wire:model="notes" class="border rounded p-2 w-full mb-4"></textarea>

                @error('amount')
                    <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="px-5 py-2 bg-red-600 text-white rounded shadow hover:bg-red-700 transition">
                    - Remove from Goal
                </button>
            </form>

        </div>


        <!-- ========================= TRANSACTION HISTORY ========================= -->
        <div class="bg-white p-6 rounded-lg shadow">

            <h3 class="text-xl font-semibold mb-4">Goal History</h3>

            @if ($goal->transactions->isEmpty())
                <p class="text-gray-500">No changes made yet.</p>
            @else
                <ul class="divide-y">

                    @foreach ($goal->transactions as $gt)
                        <li class="py-4 flex justify-between items-center">

                            <div>
                                <p class="font-semibold">
                                    @if ($gt->type === 'add')
                                        <span class="text-green-600">+ ${{ number_format($gt->amount, 2) }}</span>
                                    @else
                                        <span class="text-red-600">- ${{ number_format($gt->amount, 2) }}</span>
                                    @endif
                                </p>

                                <p class="text-sm text-gray-600">
                                    {{ $gt->date }}
                                </p>

                                @if ($gt->notes)
                                    <p class="text-xs text-gray-500 mt-1">
                                        "{{ $gt->notes }}"
                                    </p>
                                @endif
                            </div>

                        </li>
                    @endforeach

                </ul>
            @endif

        </div>

        <!-- BACK BUTTON -->
        <div class="text-center">
            <a href="{{ route('goals.index') }}"
               class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                ← Back to Goals
            </a>
        </div>

    </div>

