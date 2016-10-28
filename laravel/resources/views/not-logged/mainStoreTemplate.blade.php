<html>


<head>
    <title>@yield('mainTitle')</title>

    {{--fonts--}}
    <link href="https://fonts.googleapis.com/css?family=Kanit|Merriweather|Kaushan+Script" rel="stylesheet">

    {{--view port--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--scripts--}}
    <script src="jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/generalStrings.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/utils.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/cookieManager/js.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/productList.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/basket.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/onLoadStore.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/detailProductDialog.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/generalClickHandler.js') }}"></script>

    {{--styles--}}
    <link rel="stylesheet" href="{{ URL::asset('css/dropdownStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/headerStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/loginStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/productStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/mainStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/basketStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/dialogStyle.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/checkoutStyle.css') }}"/>
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
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
