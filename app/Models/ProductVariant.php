<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'image', 'stock', 'product_id', 'is_active'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function attributeValues()
    {
        return $this->hasMany(ProductVariantAttributeValue::class, 'product_variant_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
