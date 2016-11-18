@extends('mainTemplate')

@section('mainTitle', 'checkout')

@section('header')
    @parent
@stop

@section('mainContent')
    <br/>
    <br/>
    <div class="myOrderResponseState">
        <h2> Tu Transaccion {{$messageState}}
            <br/>
            @if($transactionState == 4)
                Puedes ver el estado de tu envio entrando a tu cuenta en la seccion Mis Ordenes!
            @endif
            @if($transactionState == 7)
                Puedes ver el estado de tu transaccion a tu cuenta en la seccion Mis Ordenes!
            @endif
        </h2>
    </div>

@stop