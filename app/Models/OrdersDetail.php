<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersDetail extends Model
{
    //
    protected $table = 'orders_details';

    public function order()
    {
        return $this->belongsTo('App\Model\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }

}
