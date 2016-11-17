<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = array('state', 'user_id', 'delivery_type', 'payment_type','coupon_code','reference_code','payu_order_reference');
    protected $table = 'storeorder';

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function user() {
        return $this->belongsTo('testmiguel\User','user_id','id');
    }

    // each order can have many products
    public function products() {
        return $this->belongsToMany('testmiguel\Product', 'storeproductorder', 'order_id', 'product_id');
    }
}
