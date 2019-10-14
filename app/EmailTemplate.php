<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    //
    protected $table='email_template';
     public $timestamp='true';
     public $fillable = [
         'name', 'mailsubject','templatecontent','template_key'
    ];
}
