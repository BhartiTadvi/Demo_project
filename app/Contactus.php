<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    //
     protected $table='contactus';
     public $timestamp='true';
     public $fillable = [
         'name', 'email','subject','message'
    ];
  
}
