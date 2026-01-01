<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'city',
        'order_details',
        'total_amount',
        'payment_method',
        'status',
    ];
public function items()
{
    return $this->hasMany(OrderItem::class);
}
}
