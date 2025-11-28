<?php

namespace App\Livewire\Goals;

use Livewire\Component;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;

class GoalsIndex extends Component
{
    public $goals;

    public function mount()
    {
        $this->goals = Goal::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.goals.goal-index');
    }
}
