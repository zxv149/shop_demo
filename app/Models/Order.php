<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function details()
    {
        return $this->hasMany('App\Models\OrdersDetail', 'o_id');
    }
}
