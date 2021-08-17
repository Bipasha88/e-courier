<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'courier_charge',
        'cost',
        'track_number',
        'delivery_status',
        'pickup_status',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('weight','price');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
