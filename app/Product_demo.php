<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_demo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_demos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['productname', 'price', 'description'];

     public function product_image() 
    {   
        return $this->belongsTo('App\Product_image', 'image_id');
    }
  

    
}
