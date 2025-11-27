<?php

namespace App\Livewire\Balance;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SetupBalance extends Component
{
    public $balance;

   public function save()
{
    $this->validate([
        'balance' => 'required|numeric|min:0'
    ]);

    /** @var \App\Models\User $user */
    $user = Auth::user();
    
    $user->starting_balance = $this->balance;
    $user->current_balance = $this->balance;
    $user->save();

    return redirect()->route('dashboard');
}


    public function render()
    {
        return view('livewire.balance.setup-balance');
    }
}
