<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'phone_number',
        'address',
        'email',
        'account_id',
        'is_active',
        'created_at',
        'updated_at'
    ];
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
