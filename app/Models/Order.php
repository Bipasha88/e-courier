<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_name',
        'sender_email',
        'sender_phone',
        'sender_address',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'cost',
        'track_number',
        'delivery_status',
        'pickup_status',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
