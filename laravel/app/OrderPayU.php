<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class OrderPayU extends Model
{
    protected $fillable = array('id','order_id','merchant_id','state_pol','risk','response_code_pol','reference_sale','reference_pol','sign','extra1','extra2','payment_method','payment_method_type','installments_number','value','tax','additional_value','transaction_date','currency','email_buyer','response_message_pol','payment_method_id','payment_method_name','ip','commision_pol','billing_address','shipping_address','phone','date');
    protected $table = 'storeorderpayu';
}
