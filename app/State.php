<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $table='states';
     public $timestamp='true';
     public $fillable = [
         'state_name','countryID'
    ];

   
     public function address()
    {
        return $this->belongsTo('App\address', 'state_id');

    }
}
