<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class TransactionsIndex extends Component
{
    public $deleteId = null;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        $transaction = Transaction::where('id', $this->deleteId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // If it's an INCOME, subtract from balance
        $user = Auth::user();
        if ($transaction->type === 'income') {
            $user->current_balance -= $transaction->amount;
        }

        // If it's an EXPENSE, add back to balance
        if ($transaction->type === 'expense') {
            $user->current_balance += $transaction->amount;
        }
        /** @var \App\Models\User $user */
        $user->save();

        $transaction->delete();

        $this->deleteId = null;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
    }

    public function render()
    {
        return view('livewire.transactions.transactions-index', [
            'transactions' => Transaction::where('user_id', Auth::id())
                ->orderBy('date', 'desc')
                ->get()
        ]);
    }
}
