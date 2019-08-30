<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
    protected $fillable = ['name'];

    // public function products() 
    // {
    //     return $this->hasMany('App\Product', 'category_id');
    // }

    public function parent()
      {
        return $this->belongsTo('App\Category', 'parent_id');
      }

     public function children() 
      { 
        return $this->hasMany('App\Category', 'parent_id', 'id'); 
      }
    


    
}
