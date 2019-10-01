<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class manage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manages';

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
    protected $fillable = ['name', 'address1', 'address2', 'city', 'zipcode', 'image'];

    
}
