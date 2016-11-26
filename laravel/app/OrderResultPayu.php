<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class OrderResultPayu extends Model
{
    //
    protected $fillable = array('id', 'order_id', 'payu_order_id', 'payu_account_id','reference_code','description','buyer_name', 'buyer_email', 'transaction_id', 'transaction_state');
    protected $table = 'orderresultpayu';
}
