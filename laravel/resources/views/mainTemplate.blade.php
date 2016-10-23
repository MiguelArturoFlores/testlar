@extends('not-logged/mainStoreTemplate')

@section('mainTitle')
    @yield('title')
@stop

@section('mainIncludes')
    @yield('includes')
@stop

@section('mainHeader')
    <div class="mainHeader">
        @if(Auth::check())
            @include('logged.headerLogged')
        @else
            @include('not-logged.headerNotLogged')
        @endif
    </div>
@stop

@section('mainContent')

    <div class="storeMainContainer">
        <div id="basketDiv" class="closeBasket">
            @include('basket.basket')
        </div>
        <div id="productListDiv" class="productListWithOutBasket">
            @yield('content')
        </div>
    </div>

@stop

