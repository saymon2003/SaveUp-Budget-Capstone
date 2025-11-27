<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class TransactionForm extends Component
{
    public $transactionId;

    public $type = '';
    public $category = '';
    public $amount;
    public $date;
    public $notes;

    // Fixed category lists
    public $incomeCategories = [
        'Salary', 'Bonus', 'Freelance', 'Business', 'Gift', 'Other Income'
    ];

    public $expenseCategories = [
        'Food', 'Transport', 'Rent', 'Bills', 'Shopping', 'Entertainment',
        'Healthcare', 'Education', 'Travel', 'Other Expense'
    ];

    public function updatedType()
    {
        $this->category = '';
    }

    public function mount($id = null)
    {
        $this->transactionId = $id;

        if ($id) {
            $t = Transaction::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $this->type     = $t->type;
            $this->category = $t->category;
            $this->amount   = $t->amount;
            $this->date     = $t->date;
            $this->notes    = $t->notes;
        }
    }

    public function save()
    {
        $this->validate([
            'type'      => 'required|in:income,expense',
            'category'  => 'required|string|max:255',
            'amount'    => 'required|numeric|min:0',
            'date'      => 'required|date',
            'notes'     => 'nullable|string',
        ]);

        Transaction::updateOrCreate(
            ['id' => $this->transactionId],
            [
                'user_id'   => Auth::id(),
                'type'      => $this->type,
                'category'  => $this->category,
                'amount'    => $this->amount,
                'date'      => $this->date,
                'notes'     => $this->notes,
            ]
        );

        return redirect()->route('transactions.index');
    }

    public function render()
    {
        return view('livewire.transactions.transaction-form');
    }
}
