<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    protected $fillable = [
        'user_id',
        'type',          // regular, fixed, target
        'target_amount', // optional, for target savings
        'maturity_date', // optional, for fixed savings
        'status',        // active/inactive
        'created_on'     // same style as requested_on in Loan
    ];

    protected $casts = [
        'created_on' => 'date', // ← this makes received_on a Carbon object
    ];

    // Saving belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Saving has many deposits
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    // Human-readable type
    public function getTypeLabelAttribute()
    {
        return match ($this->type) {
            'regular' => 'Regular Savings',
            'fixed' => 'Fixed Savings',
            'target' => 'Target Savings',
            default => 'Unknown',
        };
    }

    // Receipt number
    public function getReceiptNumberAttribute()
    {
        return 'SAV-' . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }

    // Total balance (sum of deposits)
    public function getBalanceAttribute()
    {
        return $this->deposits->sum('amount');
    }
}
