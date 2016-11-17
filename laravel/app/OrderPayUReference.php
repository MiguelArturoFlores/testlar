<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class OrderPayUReference extends Model
{
    protected $fillable = array('id','order_id','order_reference');
    protected $table = 'storeorderpayureference';

}
