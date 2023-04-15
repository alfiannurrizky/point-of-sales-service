<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'payment_id',
        'status',
        'price',
        'qty',
        'total',
        'total_paid',
        'total_return',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class,'payment_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id', 'id');
    }

}
