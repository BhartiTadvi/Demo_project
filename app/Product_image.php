<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    //
    protected $fillable = [
         'product_image',
    ];


    public function product_demo() 
    {
        return $this->hasMany('App\Product_demo', 'image_id');
    }

    
    
}
