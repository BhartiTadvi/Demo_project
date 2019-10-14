<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_management extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_managements';

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
    protected $fillable = ['customer_details_with_address', 'Ordered products', 'pagecontent'];

    
}
