<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table='user_orders';
     public $timestamp='true';
     public $fillable = [
         'user_id','address_id','subtotal','total','shipping_charge','discount_amount','coupon_code_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
     public function products() 
   {   
    return $this->hasMany('App\Product_Order');
   }

    public function orderDetail() 
   {   
    return $this->hasOne('App\OrderDetail','order_id');
   }

   

}
