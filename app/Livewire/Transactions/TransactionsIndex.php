<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionsIndex extends Component
{
    public $transactions;

    public function mount()
    {
        $this->transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();
    }

    public function delete($id)
    {
        Transaction::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        $this->mount(); // refresh list
    }

    public function render()
    {
        return view('livewire.transactions.transactions-index');
    }
}
