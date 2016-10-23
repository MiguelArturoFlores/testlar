<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;
use testmiguel\ProductImage;

class Product extends Model
{
    //
    protected $fillable = array('name', 'description', 'image', 'price','small_description','discount','has_discount', 'is_new');
    protected $table = 'storeproduct';

	// DEFINE RELATIONSHIPS --------------------------------------------------
    public function images() {
        return $this->hasMany('testmiguel\ProductImage');
    }

    public function orders() {
        return $this->belongsToMany('testmiguel\Order', 'storeproductorder', 'product_id', 'order_id');
    }
}
