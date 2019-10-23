<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponProcedure extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupon_procedures';

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
    protected $fillable = ['title', 'code', 'discount', 'quantity', 'remaining_quantity', 'type'];

    
}
