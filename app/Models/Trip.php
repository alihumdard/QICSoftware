<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    use HasFactory;

    public function addresses()
{
    return $this->hasMany(Address::class)->orderBy('order_no', 'asc');
}

public function user()
{
    return $this->belongsTo(User::class, 'client_id');
}

public function driver()
{
    return $this->belongsTo(User::class, 'driver_id');
}

}
