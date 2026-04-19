<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'interest',
        'duration',
        'total_payable',
        'eligibility',
        'status',
        'requested_on'
    ];

    protected $casts = [
        'requested_on' => 'date', // ← this makes received_on a Carbon object
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function repayments()
    {
        return $this->hasMany(Repayments::class);
    }

    public function getBalanceAttribute()
    {
        return $this->amount - $this->repayments()->sum('amount');
    }
}
