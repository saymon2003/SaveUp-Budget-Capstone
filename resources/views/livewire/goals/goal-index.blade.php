<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Your Goals</h1>

        <a href="{{ route('goals.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + New Goal
        </a>
    </div>

    @if ($goals->isEmpty())
        <div class="bg-white p-6 rounded shadow text-center text-gray-500">
            You have no goals yet.
        </div>
    @else

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            @foreach ($goals as $goal)
                <a href="{{ route('goals.show', $goal->id) }}"
                   class="block bg-white p-5 rounded shadow hover:shadow-lg transition border-l-8
                    @if($goal->current_amount >= $goal->target_amount)
                        border-green-600
                    @else
                        border-blue-600
                    @endif">

                    <p class="text-lg font-semibold">{{ $goal->name }}</p>

                    <p class="text-gray-600 text-sm mt-1">
                        Target: ${{ number_format($goal->target_amount, 2) }}
                    </p>

                    <p class="text-gray-600 text-sm">
                        Saved: ${{ number_format($goal->current_amount, 2) }}
                    </p>

                    <!-- Progress Bar -->
                    @php
                        $percent = $goal->target_amount > 0
                            ? ($goal->current_amount / $goal->target_amount) * 100
                            : 0;
                        $percent = min(100, $percent);
                    @endphp

                    <div class="mt-3">
                        <div class="w-full bg-gray-200 h-3 rounded">
                            <div class="h-3 rounded bg-blue-600"
                                 style="width: {{ $percent }}%"></div>
                        </div>

                        <p class="text-sm text-gray-500 mt-1">{{ number_format($percent, 1) }}% complete</p>
                    </div>

                </a>
            @endforeach

        </div>

    @endif

</div>
