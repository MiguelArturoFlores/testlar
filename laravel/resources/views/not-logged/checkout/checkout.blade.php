@extends('not-logged.mainStoreTemplate')

@section('mainTitle', 'checkout')

@section('mainHeader')
    @include('not-logged.checkout.headerCheckout')
@stop

@section('mainContent')

    <form id="formCheckout" action="/checkout/pay" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

        <div class="checkoutContainerDiv">
            <div class="checkoutRegisterDiv">
                @include('not-logged.checkout.registerCheckout')
            </div>
            <div class="checkoutPaymentDiv">
                @include('not-logged.checkout.paymentCheckout')
            </div>
            <div class="checkoutBasketDiv">
                @include('not-logged.checkout.basketCheckout')
            </div>
        </div>
    </form>
@stop