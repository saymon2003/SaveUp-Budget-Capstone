<?php

namespace App\Livewire\Goals;

use Livewire\Component;
use App\Models\Goal;
use App\Models\GoalTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class GoalShow extends Component
{
    public Goal $goal;        // Strong typing = NO Intelephense error
    public $amount = null;
    public $notes = null;

    public function mount($id)
{
    $this->goal = Goal::with('transactions')
        ->where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();
}


    // -------------------------
    // Add money to goal
    // -------------------------
    public function addToGoal()
    {
        $this->validate([
            'amount' => 'required|numeric|min:0.01',
            'notes'  => 'nullable|string|max:500',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($this->amount > $user->current_balance) {
            throw ValidationException::withMessages([
                'amount' => 'You do not have enough balance.',
            ]);
        }

        // Update user balance
        $user->current_balance -= $this->amount;
        $user->save();

        // Update goal amount
        $this->goal->current_amount += $this->amount;
        $this->goal->save();

        // Record transaction
        GoalTransaction::create([
            'goal_id' => $this->goal->id,
            'type'    => 'add',
            'amount'  => $this->amount,
            'date'    => now(),
            'notes'   => $this->notes,
        ]);

        $this->reset('amount', 'notes');
        $this->goal->refresh();
    }

    // -------------------------
    // Remove money from goal
    // -------------------------
    public function removeFromGoal()
    {
        $this->validate([
            'amount' => 'required|numeric|min:0.01',
            'notes'  => 'nullable|string|max:500',
        ]);

        if ($this->amount > $this->goal->current_amount) {
            throw ValidationException::withMessages([
                'amount' => 'Cannot remove more than the goal currently has.',
            ]);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Add back to user balance
        $user->current_balance += $this->amount;
        $user->save();

        // Remove from goal
        $this->goal->current_amount -= $this->amount;
        $this->goal->save();

        // Record transaction
        GoalTransaction::create([
            'goal_id' => $this->goal->id,
            'type'    => 'remove',
            'amount'  => $this->amount,
            'date'    => now(),
            'notes'   => $this->notes,
        ]);

        $this->reset('amount', 'notes');
        $this->goal->refresh();
    }

    public function render()
    {
        return view('livewire.goals.goal-show');
    }
}
