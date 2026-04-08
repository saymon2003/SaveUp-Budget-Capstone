<div class="space-y-8">

    <!-- HERO -->
    <section class="relative overflow-hidden rounded-[28px] bg-gradient-to-br from-blue-950 via-blue-800 to-sky-500 px-10 py-10 shadow-[0_20px_60px_rgba(30,64,175,0.35)]">
        <div class="absolute -right-10 -top-10 h-44 w-44 rounded-full bg-white/10 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 h-32 w-32 rounded-full bg-cyan-300/20 blur-2xl"></div>

        <div class="relative flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-blue-100/80">
                    SaveUp Overview
                </p>

                <h1 class="mt-4 text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Hello, {{ auth()->user()->name }} 👋
                </h1>

                <p class="mt-4 max-w-2xl text-lg md:text-xl text-blue-100/90 leading-relaxed">
                    Welcome back to your SaveUp dashboard. Track your balance, monitor your goals,
                    and keep your financial progress moving in the right direction.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 min-w-[280px]">
                <div class="rounded-2xl bg-white/10 backdrop-blur-md p-5 border border-white/15 shadow-lg">
                    <p class="text-sm font-medium text-blue-100">Status</p>
                    <p class="mt-2 text-2xl font-bold text-white">Active</p>
                </div>

                <div class="rounded-2xl bg-white/10 backdrop-blur-md p-5 border border-white/15 shadow-lg">
                    <p class="text-sm font-medium text-blue-100">Goals</p>
                    <p class="mt-2 text-2xl font-bold text-white">{{ $recentGoals->count() }}</p>
                </div>

                <div class="rounded-2xl bg-white/10 backdrop-blur-md p-5 border border-white/15 shadow-lg col-span-2">
                    <p class="text-sm font-medium text-blue-100">Current Balance</p>
                    <p class="mt-2 text-4xl font-extrabold text-white">
                        @if($balance !== null)
                            ${{ number_format($balance, 2) }}
                        @else
                            Not set
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>

    @if ($balance === null)

        <!-- SETUP BALANCE -->
        <section class="rounded-[26px] bg-white p-8 md:p-10 shadow-[0_18px_40px_rgba(15,23,42,0.08)] border border-slate-200">
            <div class="max-w-2xl mx-auto text-center">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 text-2xl font-bold shadow-sm">
                    $
                </div>

                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">
                    Set Your Starting Balance
                </h2>

                <p class="mt-4 text-lg text-slate-500 leading-relaxed">
                    Before you start tracking expenses and savings goals, tell SaveUp how much you currently have.
                </p>

                <form wire:submit.prevent="saveInitialBalance" class="mt-8 space-y-5 max-w-md mx-auto">
                    <input
                        type="number"
                        wire:model="balance"
                        class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-5 py-4 text-center text-xl font-semibold text-slate-800 shadow-sm focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                        placeholder="Enter your balance"
                    >

                    @error('balance')
                        <p class="text-sm font-medium text-red-600">{{ $message }}</p>
                    @enderror

                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-gradient-to-r from-blue-700 to-sky-500 px-6 py-4 text-lg font-bold text-white shadow-lg transition hover:scale-[1.01] hover:from-blue-800 hover:to-sky-600"
                    >
                        Save Balance
                    </button>
                </form>
            </div>
        </section>

    @else

        <!-- QUICK STATS -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="rounded-[24px] bg-white p-7 shadow-[0_14px_30px_rgba(15,23,42,0.08)] border border-slate-200">
                <p class="text-sm font-semibold uppercase tracking-[0.22em] text-blue-700">Balance</p>
                <p class="mt-4 text-4xl font-extrabold tracking-tight text-emerald-600">
                    ${{ number_format($balance, 2) }}
                </p>
                <p class="mt-3 text-base text-slate-500">Your available balance right now.</p>
            </div>

            <div class="rounded-[24px] bg-white p-7 shadow-[0_14px_30px_rgba(15,23,42,0.08)] border border-slate-200">
                <p class="text-sm font-semibold uppercase tracking-[0.22em] text-blue-700">Goals</p>
                <p class="mt-4 text-4xl font-extrabold tracking-tight text-slate-900">
                    {{ $recentGoals->count() }}
                </p>
                <p class="mt-3 text-base text-slate-500">Goals currently showing on your dashboard.</p>
            </div>

            <div class="rounded-[24px] bg-white p-7 shadow-[0_14px_30px_rgba(15,23,42,0.08)] border border-slate-200">
                <p class="text-sm font-semibold uppercase tracking-[0.22em] text-blue-700">Transactions</p>
                <p class="mt-4 text-4xl font-extrabold tracking-tight text-slate-900">
                    {{ $recentTransactions->count() }}
                </p>
                <p class="mt-3 text-base text-slate-500">Recent transactions visible below.</p>
            </div>
        </section>

        <!-- GOALS + TRANSACTIONS -->
        <section class="grid grid-cols-1 xl:grid-cols-2 gap-8">

            <!-- GOALS CARD -->
            <div class="rounded-[28px] bg-white p-8 shadow-[0_18px_40px_rgba(15,23,42,0.08)] border border-slate-200">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-blue-700">Progress</p>
                        <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">Your Goals</h2>
                    </div>
                </div>

                @if ($recentGoals->isEmpty())
                    <div class="rounded-2xl bg-slate-50 border border-dashed border-slate-300 p-8 text-center">
                        <p class="text-lg font-semibold text-slate-700">No goals created yet</p>
                        <p class="mt-2 text-slate-500">Start a goal and track your savings progress here.</p>
                    </div>
                @else
                    <div class="space-y-5">
                        @foreach ($recentGoals as $g)
                            @php
                                $percent = $g->target_amount > 0 ? min(100, ($g->current_amount / $g->target_amount) * 100) : 0;
                            @endphp

                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 shadow-sm hover:shadow-md transition">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-slate-900">{{ $g->name }}</h3>
                                        <p class="mt-2 text-base text-slate-500">
                                            Saved <span class="font-bold text-slate-800">${{ number_format($g->current_amount, 2) }}</span>
                                            of
                                            <span class="font-bold text-slate-800">${{ number_format($g->target_amount, 2) }}</span>
                                        </p>
                                    </div>

                                    @if ($g->isAchieved)
                                        <span class="rounded-full bg-emerald-100 px-4 py-2 text-sm font-bold text-emerald-700">
                                            Achieved
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-5">
                                    <div class="h-3.5 w-full rounded-full bg-slate-200 overflow-hidden">
                                        <div class="h-full rounded-full bg-gradient-to-r from-blue-700 to-sky-500"
                                             style="width: {{ $percent }}%"></div>
                                    </div>
                                    <p class="mt-2 text-sm font-semibold text-slate-500">
                                        {{ number_format($percent, 1) }}% complete
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- TRANSACTIONS CARD -->
            <div class="rounded-[28px] bg-white p-8 shadow-[0_18px_40px_rgba(15,23,42,0.08)] border border-slate-200">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.22em] text-blue-700">Activity</p>
                    <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">Recent Transactions</h2>
                </div>

                @if ($recentTransactions->isEmpty())
                    <div class="rounded-2xl bg-slate-50 border border-dashed border-slate-300 p-8 text-center">
                        <p class="text-lg font-semibold text-slate-700">No recent transactions</p>
                        <p class="mt-2 text-slate-500">Your latest income and expenses will appear here.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($recentTransactions as $t)
                            <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 p-5 shadow-sm hover:shadow-md transition">
                                <div>
                                    <p class="text-xl font-bold text-slate-900">{{ $t->category }}</p>
                                    <p class="mt-1 text-sm text-slate-500">{{ $t->date }}</p>
                                </div>

                                <div class="text-right">
                                    @if ($t->type === 'income')
                                        <p class="text-2xl font-extrabold text-emerald-600">+${{ number_format($t->amount, 2) }}</p>
                                        <p class="text-sm font-medium text-emerald-600/80">Income</p>
                                    @else
                                        <p class="text-2xl font-extrabold text-rose-600">-${{ number_format($t->amount, 2) }}</p>
                                        <p class="text-sm font-medium text-rose-600/80">Expense</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </section>

    @endif
</div>