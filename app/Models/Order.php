<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $table = 'products_order';

    protected $fillable = [
        'product_id',
        'order_id',
        'price'
    ];

    public $timestamps = false;
}
