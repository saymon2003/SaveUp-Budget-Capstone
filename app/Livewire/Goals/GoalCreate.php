<?php

namespace App\Livewire\Goals;

use Livewire\Component;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;

class GoalCreate extends Component
{
    public $name;
    public $target_amount;
    public $deadline;
    public $notes;

    public function save()
    {
        $this->validate([
            'name'           => 'required|string|max:255',
            'target_amount'  => 'required|numeric|min:0.01',
            'deadline'       => 'nullable|date|after:today',
            'notes'          => 'nullable|string|max:500',
        ]);

        Goal::create([
            'user_id'        => Auth::id(),
            'name'           => $this->name,
            'target_amount'  => $this->target_amount,
            'deadline'       => $this->deadline,
            'notes'          => $this->notes,
            'current_amount' => 0,
        ]);

        return redirect()->route('goals.index');
    }

    public function render()
    {
        return view('livewire.goals.goal-create');
    }
}
