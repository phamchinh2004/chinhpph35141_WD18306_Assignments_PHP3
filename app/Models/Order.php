<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "total_cost",
        "shipping_price",
        "shipping_voucher",
        "voucher",
        "total_payment",
        "account_id",
        "created_at",
        "updated_at"
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
