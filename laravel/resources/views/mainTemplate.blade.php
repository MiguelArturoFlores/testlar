<html>

<head>
    <title>@yield('title')</title>
    <script type="text/javascript" src="{{ URL::asset('js/productList.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/basket.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/productStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/mainStyle.css') }}"/>
</head>
<body>

@section('header')

    <div class="mainHeader">
        @if(session()->has('session-token'))
            @include('logged.headerLogged')
        @else
            @include('not-logged.headerNotLogged')
        @endif
    </div>

@show

<div class="container">
    @yield('content')
</div>

</body>
</html>