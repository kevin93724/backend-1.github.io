<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;
    protected $keyType = 'integer';

    protected $fillable = ['order_id', 'product_id', 'qty', 'price'];


}
