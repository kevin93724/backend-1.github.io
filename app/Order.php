<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $keyType = 'integer';
    protected $fillable = ['user_id', 'recipient_name', 'recipient_phone', 'recipient_address', 'shipment_time', 'total_price', 'shipment_status', 'payment_status', 'created_at', 'updated_at'];

    public function order_datails()
    {
        return $this->hasMany('App\OrderDetail');
    }
}
