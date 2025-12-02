<?php

namespace App\Livewire\Goals;

use Livewire\Component;
use App\Models\Goal;
use App\Models\GoalTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class GoalShow extends Component
{
    public $goal;
    public $amount;
    public $notes;

    public function mount($id)
    {
        $this->goal = Goal::with('transactions')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    }

    /**
     * Add money to goal (capped)
     */
    public function addToGoal()
    {
        $this->validate([
            'amount' => 'required|numeric|min:0.01',
            'notes'  => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $remaining = $this->goal->target_amount - $this->goal->current_amount;

        if ($remaining <= 0) {
            throw ValidationException::withMessages([
                'amount' => 'This goal is already achieved.',
            ]);
        }

        if ($this->amount > $user->current_balance) {
            throw ValidationException::withMessages([
                'amount' => 'Not enough balance.',
            ]);
        }

        $amountToAdd = min($this->amount, $remaining);

        // Update user balance
        $user->current_balance -= $amountToAdd;
                /** @var \App\Models\User $user */
        $user->save();

        // Update goal amount
        $this->goal->current_amount += $amountToAdd;
        $this->goal->save();

        // Log transaction
        GoalTransaction::create([
            'goal_id' => $this->goal->id,
            'type'    => 'add',
            'amount'  => $amountToAdd,
            'date'    => now(),
            'notes'   => $this->notes,
        ]);

        $this->reset(['amount', 'notes']);
        $this->goal->refresh();
    }

    /**
     * Remove money from goal
     */
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

        // Add back to balance
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->current_balance += $this->amount;
        $user->save();

        // Subtract from goal
        $this->goal->current_amount -= $this->amount;
        $this->goal->save();

        // Log transaction
        GoalTransaction::create([
            'goal_id' => $this->goal->id,
            'type'    => 'remove',
            'amount'  => $this->amount,
            'date'    => now(),
            'notes'   => $this->notes,
        ]);

        $this->reset(['amount', 'notes']);
        $this->goal->refresh();
    }

    /**
     * Delete a goal
     */
    public function deleteGoal()
    {
        $this->goal->transactions()->delete();
        $this->goal->delete();

        return redirect()->route('goals.index');
    }

    public function render()
    {
        return view('livewire.goals.goal-show');
    }
}
