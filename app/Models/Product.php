<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'SKU',
        'image',
        'purchase_price',
        'sale_price',
        'view',
        'description',
        'is_active',
        'category_id'
    ];
    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
