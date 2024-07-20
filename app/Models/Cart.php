<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'product_id',
        'product_variant_id',
        'account_id',
        'created_at',
        'updated_at'
    ];
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
