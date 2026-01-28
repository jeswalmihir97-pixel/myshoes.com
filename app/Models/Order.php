<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

      protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'address', 'payment_method', 'total'
    ];

    // Define Relationship: One Order has many OrderItems
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
