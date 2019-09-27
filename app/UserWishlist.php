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

}
