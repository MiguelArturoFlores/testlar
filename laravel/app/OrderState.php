<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class OrderState extends Model
{

    const ORDER_TEMPORAL = 0;
    const ORDER_PENDING_PAYMENT = 1;
    const ORDER_PAYMENT_COMPLETE = 2;
    const ORDER_BEING_PROCESSED = 3;
    const ORDER_BEING_DELIVERED = 4;
    const ORDER_COMPLETE = 5;

}
