<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = ['title', 'type', 'status', 'created_by'];
    public static $rules = [
        'title'  => 'required',
        'status' => 'required',
        'type'   => 'required',
    ];
}
