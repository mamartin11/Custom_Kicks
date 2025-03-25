<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
        'username',
        'email',
        'password',
        'budget',
    ];

    protected $hidden = [
        'password',
    ];

    // relations

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
