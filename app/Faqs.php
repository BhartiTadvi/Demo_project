<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_no', 'question', 'answer','status'];
}
