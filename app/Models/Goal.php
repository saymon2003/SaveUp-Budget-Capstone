<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GoalTransaction;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'target_amount',
        'current_amount',
        'deadline',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // FIX: This must be named `transactions` for blade to work
    public function transactions()
    {
        return $this->hasMany(GoalTransaction::class, 'goal_id');
    }
}
