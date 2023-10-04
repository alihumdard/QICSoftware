<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table = 'currencies';

    protected $fillable = ['name', 'code', 'type', 'created_by'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function getCodeAttribute($value)
    {
        return strtoupper($value);
    }

    public static $rules = [
        'name' => 'required|unique:currencies,name',
        'code' => 'required|unique:currencies,code|alpha|size:3',
        'type' => 'required|integer',
    ];
}
