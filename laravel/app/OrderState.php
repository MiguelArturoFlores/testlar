<?php

namespace testmiguel;

use Illuminate\Database\Eloquent\Model;

class OrderState extends Model
{

    const ORDER_TEMPORAL = 0;
    const ORDER_PENDING_PAYMENT = 1;
    const ORDER_PAYMENT_COMPLETE = 2;
    const ORDER_PAYMENT_REJECTED = 3;
    const ORDER_PAYMENT_EXPIRED = 4;
    const ORDER_BEING_PROCESSED = 5;
    const ORDER_BEING_DELIVERED = 6;
    const ORDER_COMPLETE = 7;

    const PAYU_ORDER_APPROVED = 4;
    const PAYU_ORDER_EXPIRED = 5;
    const PAYU_ORDER_DECLINED = 6;

}
