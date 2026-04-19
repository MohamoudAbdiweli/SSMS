<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'saving_id',
        'amount',
        'withdrawn_on'
    ];

    protected $casts = [
        'withdrawn_on' => 'date', // ← this makes received_on a Carbon object
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
