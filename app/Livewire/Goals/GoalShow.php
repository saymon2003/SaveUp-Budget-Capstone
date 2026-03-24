<?php

namespace App\Livewire\Goals;
use Illuminate\Support\Facades\DB;
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

    DB::transaction(function () {

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }

        // 🔒 Lock user row
        $user = \App\Models\User::where('id', $user->id)
            ->lockForUpdate()
            ->firstOrFail();

        // 🔒 Lock goal row
        $goal = \App\Models\Goal::where('id', $this->goal->id)
            ->where('user_id', $user->id)
            ->lockForUpdate()
            ->firstOrFail();

        $remaining = $goal->target_amount - $goal->current_amount;

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

        $user->current_balance -= $amountToAdd;
        $user->save();

        $goal->current_amount += $amountToAdd;
        $goal->save();

        GoalTransaction::create([
            'goal_id' => $goal->id,
            'type'    => 'add',
            'amount'  => $amountToAdd,
            'date'    => now(),
            'notes'   => $this->notes,
        ]);
    });

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

    DB::transaction(function () {

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }

        $user = \App\Models\User::where('id', $user->id)
            ->lockForUpdate()
            ->firstOrFail();

        $goal = \App\Models\Goal::where('id', $this->goal->id)
            ->where('user_id', $user->id)
            ->lockForUpdate()
            ->firstOrFail();

        if ($this->amount > $goal->current_amount) {
            throw ValidationException::withMessages([
                'amount' => 'Cannot remove more than the goal currently has.',
            ]);
        }

        $user->current_balance += $this->amount;
        $user->save();

        $goal->current_amount -= $this->amount;
        $goal->save();

        GoalTransaction::create([
            'goal_id' => $goal->id,
            'type'    => 'remove',
            'amount'  => $this->amount,
            'date'    => now(),
            'notes'   => $this->notes,
        ]);
    });

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
