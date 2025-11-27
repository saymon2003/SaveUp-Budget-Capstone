<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;

#[Layout('components.layouts.app')]
class Dashboard extends Component
{
    public $balance;
    public $recentTransactions;

    public function mount()
    {
        /** @var User $user */
        $user = Auth::user();

        $this->balance = $user->current_balance;

        $this->recentTransactions = Transaction::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->limit(5)
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
