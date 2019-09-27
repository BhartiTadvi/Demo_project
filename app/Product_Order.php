<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Order extends Model
{
    //
     protected $table='products_orders';
     public $timestamp='true';
     public $fillable = [
         'order_id','product_id','quantity'
    ];


    public function order() 
   {   
    return $this->belongsTo('App\UserOrder','order_id','id');
   }

   public function product() 
   {   
    return $this->belongsTo('App\Product','product_id','id');
   }

}
