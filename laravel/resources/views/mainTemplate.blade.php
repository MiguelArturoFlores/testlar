<html>

<head>
    <title>@yield('title')</title>
    <script src="jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/cookieManager/js.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/productList.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/basket.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('js/onLoadStore.js') }}"></script>

    <link rel="stylesheet" href="{{ URL::asset('css/productStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/mainStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/basketStyle.css') }}"/>
</head>
<body>

@section('header')

    <div class="mainHeader">
        @if(Auth::check())
            @include('logged.headerLogged')
        @else
            @include('not-logged.headerNotLogged')
        @endif
    </div>

@show

<div class="container">
    <div id="basketDiv" class="closeBasket">
        @include('basket.basket')
    </div>
    <div id="productListDiv" class="productListWithOutBasket">
        @yield('content')
   </div>
</div>

</body>
</html>
