<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Penting: Tambahkan ini

class Order extends Model
{
    protected $fillable = [
        'user_id', // Pastikan ini ada jika Anda menggunakan mass assignment
        'first_name', 'last_name', 'address', 'apartment', 'city', 'province',
        'postal_code', 'phone', 'payment_proof', 'shipping_cost', 'total_amount', 'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user() // Relasi yang dicari
    {
        return $this->belongsTo(User::class);
    }
}