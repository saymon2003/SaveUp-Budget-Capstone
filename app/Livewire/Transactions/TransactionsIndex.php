<?php

namespace App\Livewire\Transactions;
use Illuminate\Support\Facades\DB;
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

    /** @var \App\Models\User $user */
    $user = Auth::user();

    DB::transaction(function () use ($transaction, $user) {

        // Reverse balance effect
        if ($transaction->type === 'income') {
            $user->current_balance -= $transaction->amount;
        }

        if ($transaction->type === 'expense') {
            $user->current_balance += $transaction->amount;
        }

        $user->save();
        $transaction->delete();
    });

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
