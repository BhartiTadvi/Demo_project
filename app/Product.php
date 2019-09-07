<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
    protected $fillable = ['productname', 'price', 'description'];

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
    return $this->hasOne('App\Products_categories');
   }

    public function parentCategory() 
   {   
    return $this->hasOne('App\Category','parent_id');
   }
    
    
}
