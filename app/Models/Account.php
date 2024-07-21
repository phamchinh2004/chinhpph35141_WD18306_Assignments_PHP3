<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'password',
        'role',
        'is_active',
        'created_at',
        'updated_at'
    ];
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'account_id');
    }
    public function informations()
    {
        return $this->hasMany(Information::class);
    }
}
