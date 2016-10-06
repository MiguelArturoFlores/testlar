<html>

<head>
    <title>@yield('title')</title>
    <script type="text/javascript" src="{{ URL::asset('js/productList.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/basket.js') }}"></script>
    <script src="jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/productStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/mainStyle.css') }}"/>
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
