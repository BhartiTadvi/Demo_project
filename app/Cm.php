<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cm extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cms';

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
    protected $fillable = ['type', 'description', 'status'];

    
}
