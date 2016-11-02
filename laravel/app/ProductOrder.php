<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $fillable = array('name', 'product_id', 'order_id', 'description', 'image', 'price','small_description','discount','has_discount', 'is_new');
    protected $table = 'storeproductorder';


}
