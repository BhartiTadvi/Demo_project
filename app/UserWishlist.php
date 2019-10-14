<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWishlist extends Model
{
    //
    protected $table='user_wish_list';
     public $timestamp='true';
     public $fillable = [
         'user_id','product_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    
     public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function userDetail() 
   {   
    return $this->hasMany('App\User','id','user_id');
   }
    public function productDetail() 
   {   
    return $this->hasMany('App\Product','id','product_id');
   }
}
