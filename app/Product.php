<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
     use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
    protected $fillable = ['productname', 'price', 'description','deleted_at'];

   public function categories() 
    {   
      return $this->belongsToMany('App\Category','products_categories','product_id','category_id');
    }

    public function productImage() 
   {   
    return $this->hasMany('App\Product_image','product_id');
   }

   public function productCategories() 
   {   
    return $this->hasOne('App\Products_categories','product_id');
   }

    public function parentCategory() 
   {   
    return $this->hasOne('App\Category','parent_id');
   }

   public function wishList() 
   {   
    return $this->hasMany('App\UserWishlist','product_id');
   }

    public function productOrder() 
   {   
    return $this->hasMany('App\Product_Order');
   }

   public function orders() 
    {   
      return $this->belongsToMany('App\Order','Product_Order','order_id','product_id');
    }
    
    
}
