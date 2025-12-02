<?php

namespace App\Livewire\Goals;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Goal;

class GoalsIndex extends Component
{
    public function render()
    {
        return view('livewire.goals.goal-index', [
            'goals' => Goal::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }
}
