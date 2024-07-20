<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
