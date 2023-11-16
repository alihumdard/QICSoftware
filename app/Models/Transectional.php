<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transectional extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'admin_id', 'sadmin_id', 'created_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function super_admin()
    {
        return $this->belongsTo(User::class, 'sadmin_id', 'id');
    }
}
