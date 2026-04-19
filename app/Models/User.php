<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    // Relationship with deposits
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function savings()
    {
        return $this->hasMany(Saving::class);
    }
}
