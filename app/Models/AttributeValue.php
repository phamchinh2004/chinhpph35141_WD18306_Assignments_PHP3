<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'value','image', 'attribute_id'
    ];
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    public function productVariantAttributeValues()
    {
        return $this->hasMany(ProductVariantAttributeValue::class);
    }
}
