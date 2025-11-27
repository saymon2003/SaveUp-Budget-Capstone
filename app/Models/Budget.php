<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'monthly_limit',
        'month',
        'year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
