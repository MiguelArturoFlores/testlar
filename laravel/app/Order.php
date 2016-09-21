<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = array('state', 'user_id', 'delivery_type', 'payment_type','coupon_code');
    protected $table = 'storeorder';

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function user() {
        return $this->belongsTo('testmiguel\User');
    }
}
