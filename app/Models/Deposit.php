<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = ['user_id', 'saving_id', 'amount', 'deposited_on'];

    protected $casts = [
        'deposited_on' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Rename relationship to avoid conflict
    public function savingRelation()
    {
        return $this->belongsTo(Saving::class, 'saving_id');
    }
}
