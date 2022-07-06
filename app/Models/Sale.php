<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'discount',
        'amount',
        'sold_at',
        'status',
        'unit_price',
        'total_price'
    ];


    function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
