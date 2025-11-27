<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionsIndex extends Component
{
    public $transactions;

    public $deleteId = null;
    public $showNotes = false;
    public $noteContent = '';

    public function mount()
    {
        $this->transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();
    }

    // ================= NOTES ==================

    public function openNotes($id)
    {
        $t = Transaction::findOrFail($id);
        $this->noteContent = $t->notes;
        $this->showNotes = true;
    }

    public function closeNotes()
    {
        $this->showNotes = false;
        $this->noteContent = '';
    }

    // ================= DELETE ===================

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
    }

    public function deleteConfirmed()
    {
        Transaction::where('id', $this->deleteId)
            ->where('user_id', Auth::id())
            ->delete();

        $this->deleteId = null;
        $this->mount(); // refresh list
    }

    public function render()
    {
        return view('livewire.transactions.transactions-index');
    }
}
