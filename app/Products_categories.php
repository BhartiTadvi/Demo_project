<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products_categories extends Model
{
    //
    protected $fillable = [
         'category_id','product_id',
    ];


    public function category() 
   {   
    return $this->belongsTo('App\Category','category_id','id');
   }

   public function product() 
   {   
    return $this->belongsTo('App\Product','product_id','id');
   }

 



}
