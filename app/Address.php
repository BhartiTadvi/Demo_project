<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

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
    protected $fillable = ['name', 'address1','country_id','state_id', 'address2', 'country', 'state', 'city', 'zipcode', 'mobileno'];
   
        public function country()
    {
        return $this->hasOne('App\Country', 'id','country_id');

    }
   public function state()
{
    return $this->hasOne('App\State', 'id','state_id');
}
    
}
