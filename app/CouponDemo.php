<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponDemo extends Model
{
    //
     protected $table='democoupons';
     public $timestamp='true';
     public $fillable = [
         'title','code','type','quantity','remaining_quantity','discount'
    ];
}
