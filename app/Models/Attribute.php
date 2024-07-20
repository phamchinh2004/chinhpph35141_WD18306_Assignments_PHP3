<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
