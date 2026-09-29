<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'stock', 'category', 'image', 'is_active'
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'film_roll' => 'Film Roll',
            'print'     => 'Print',
            'accessory' => 'Service & Accessory',
            default     => ucfirst($this->category),
        };
    }
}