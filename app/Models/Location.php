<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contract;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations';

    protected $fillable = ['name', 'code', 'type', 'sadmin_id', 'created_by'];

    public function location()
    {
        return $this->hasOne(Contract::class);
    }

    public static $rules = [
        'name' => 'required|unique:locations,name',
        'code' => 'required|unique:locations,code|alpha',
        'type' => 'required|alpha',
    ];
}
