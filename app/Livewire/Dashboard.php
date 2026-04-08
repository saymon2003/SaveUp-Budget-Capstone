<?php

namespace App\Livewire;

use App\Models\Goal;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public $balance;
    public $recentGoals;
    public $recentTransactions;

    public function mount()
    {
        $user = Auth::user();

        $this->balance = $user->current_balance;

        $this->recentTransactions = Transaction::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        $this->recentGoals = Goal::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
    }

    public function saveInitialBalance()
    {
        $this->validate([
            'balance' => 'required|numeric|min:0',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->starting_balance = $this->balance;
        $user->current_balance = $this->balance;
        $user->save();

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}