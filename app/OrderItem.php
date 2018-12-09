<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'size'];

    public function product()
    {
    	return $this->hasOne(Product::class, 'id', 'product_id');
    }
}

