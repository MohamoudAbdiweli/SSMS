<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repayments extends Model
{
    protected $fillable = [
        'user_id',
        'loan_id',
        'amount',
        'paid_on',
    ];

    protected $casts = [
        'paid_on' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
