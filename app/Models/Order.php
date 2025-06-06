<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'address', 'apartment', 'city', 'province',
        'postal_code', 'phone', 'payment_proof', 'shipping_cost', 'total_amount', 'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}