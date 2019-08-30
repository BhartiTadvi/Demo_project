<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banners_management extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners_managements';

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
    protected $fillable = ['name', 'image'];

    
}
