<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sizes',
        'gender',
        'price',
        'discount',
        'stock',
        'shipping_cost',
        'category_id',
        'image', // Keep this if you still use it for something (e.g., initial shop preview fallback)
        'image_front', // ADD THIS LINE
        'image_back'   // ADD THIS LINE
    ];

    protected $casts = [
        'sizes' => 'array',
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}