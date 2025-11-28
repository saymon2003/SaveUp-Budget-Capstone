<x-app-layout>

    <div class="max-w-4xl mx-auto">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Your Goals</h1>

            <a href="{{ route('goals.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
                + Add Goal
            </a>
        </div>

        <!-- IF NO GOALS -->
        @if ($goals->isEmpty())
            <div class="bg-white p-6 text-center rounded shadow">
                <p class="text-gray-500 mb-4">You don't have any goals yet.</p>

                <a href="{{ route('goals.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
                    Create Your First Goal
                </a>
            </div>
        @else

            <!-- GOAL CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                @foreach ($goals as $goal)
                    <a href="{{ route('goals.show', $goal->id) }}"
                       class="block bg-white shadow rounded-lg p-5 hover:shadow-lg transition">

                        <!-- GOAL NAME -->
                        <h2 class="text-lg font-semibold mb-2">
                            {{ $goal->name }}
                        </h2>

                        <!-- AMOUNT -->
                        <p class="text-gray-600 mb-1">
                            Saved: <span class="font-semibold">${{ number_format($goal->current_amount, 2) }}</span>
                            / ${{ number_format($goal->target_amount, 2) }}
                        </p>

                        <!-- PROGRESS BAR -->
                        @php
                            $percent = min(100, ($goal->current_amount / $goal->target_amount) * 100);
                        @endphp

                        <div class="w-full bg-gray-200 rounded-full h-3 mt-2">
                            <div class="bg-green-500 h-3 rounded-full"
                                 style="width: {{ $percent }}%">
                            </div>
                        </div>

                        <!-- PERCENTAGE -->
                        <p class="mt-2 text-sm text-gray-700 font-medium">
                            {{ number_format($percent, 1) }}% Complete
                        </p>

                    </a>
                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>
