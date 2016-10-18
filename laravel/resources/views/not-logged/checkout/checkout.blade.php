@extends('not-logged.mainStoreTemplate')

@section('mainTitle', 'checkout')

@section('mainHeader')

@stop

@section('mainContent')

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
@stop