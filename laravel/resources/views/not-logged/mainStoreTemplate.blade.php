<html>

<head>
    <title>@yield('mainTitle')</title>
    <script src="jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/utils.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/cookieManager/js.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/productList.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/basket.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/onLoadStore.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/detailProductDialog.js') }}"></script>

    <link rel="stylesheet" href="{{ URL::asset('css/loginStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/productStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/mainStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/basketStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/dialogStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/checkoutStyle.css') }}"/>
    @section('mainIncludes')
    @show
</head>
<body>

@section('mainHeader')

@show

@section('mainContent')

@show

@include('dialog/detailProduct')

</body>
</html>
