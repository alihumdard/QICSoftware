<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'trip_addresses';
    
    public function trip()
{
    return $this->belongsTo(Trip::class);
}

}
