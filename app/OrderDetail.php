<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table='order_details';
     public $timestamp='true';
     public $fillable = [
         'order_id','transaction_id','transaction_status','payment_mode','status'
    ];

    public function getorder()
    {
        return $this->belongsTo('App\Order');
    }

}
