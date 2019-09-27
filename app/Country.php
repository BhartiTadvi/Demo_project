<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table='countries';
     public $timestamp='true';
     public $fillable = [
         'country_name'
    ];
    
        public function address()
    {
        return $this->belongsTo('App\address', 'country_id');

    }



}
