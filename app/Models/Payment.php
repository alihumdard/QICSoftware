<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'sub_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
