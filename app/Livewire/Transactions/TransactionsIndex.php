<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class TransactionsIndex extends Component
{
    public $transactions = [];

    public $modalType = null; // "view" or "delete"
    public $modalContent = null; 
    public $modalTransactionId = null;

    public function mount()
    {
        $this->transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();
    }

    // Open View Notes modal
    public function openViewModal($notes)
    {
        $this->modalType = "view";
        $this->modalContent = $notes;
        $this->modalTransactionId = null;
    }

    // Open Delete modal
    public function openDeleteModal($id)
    {
        $this->modalType = "delete";
        $this->modalTransactionId = $id;
        $this->modalContent = null;
    }

    // Close any modal
    public function closeModal()
    {
        $this->modalType = null;
        $this->modalContent = null;
        $this->modalTransactionId = null;
    }

    // Delete confirmed
    public function delete()
    {
        if ($this->modalTransactionId) {
            Transaction::where('id', $this->modalTransactionId)
                ->where('user_id', Auth::id())
                ->delete();
        }

        $this->closeModal();

        // Refresh data
        $this->transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.transactions.transactions-index');
    }
}
