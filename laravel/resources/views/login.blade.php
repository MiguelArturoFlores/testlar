@extends('mainTemplate')

@section('title', 'Tienda Online')

@section('header')
    @parent
@stop

@section('content')

    <div class="generalLoginDiv">
        @include('not-logged/login')
    </div>
    <div class="generalRegisterDiv">
        @include('not-logged/register')
    </div>

@stop
