@extends('not-logged.mainStoreTemplate')

@section('mainTitle', 'checkout')

@section('mainHeader')
    @include('not-logged.checkout.headerCheckout')
@stop

@section('mainContent')

    Redirecting to payu...
    <form id="payuForm" method="post" action="https://sandbox.gateway.payulatam.com/ppp-web-gateway/">
        <input name="merchantId"    type="hidden"  value="{{$merchantId}}"   >
        <input name="accountId"     type="hidden"  value="{{$accountId}}" >
        <input name="description"   type="hidden"  value="{{$description}}"  >
        <input name="referenceCode" type="hidden"  value="{{$reference}}" >
        <input name="amount"        type="hidden"  value="{{$amount}}"   >
        <input name="tax"           type="hidden"  value="0"  >
        <input name="taxReturnBase" type="hidden"  value="0" >
        <input name="currency"      type="hidden"  value="{{$currency}}" >
        <input name="signature"     type="hidden"  value="{{$signature}}"  >
        <input name="test"          type="hidden"  value="{{$amount}}" >
        <input name="buyerEmail"    type="hidden"  value="{{$user->email}}" >
        <input name="responseUrl"    type="hidden"  value="http://www.test.com/response" >
        <input name="confirmationUrl"    type="hidden"  value="http://www.test.com/confirmation" >
        <input name="Submit"        type="submit"  value="Enviar" >
    </form>

@stop