<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['user_id', 'source', 'amount', 'received_on'];

    protected $casts = [
        'received_on' => 'date', // ← this makes received_on a Carbon object
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
