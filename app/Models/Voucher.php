<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "code",
        "amount",
        "quantity",
        "image",
        "type",
        "start_date",
        "end_date",
        "minimum_order_value",
        "is_active",
        "created_at",
        "updated_at"
    ];
}
