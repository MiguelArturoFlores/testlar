@extends('mainTemplate')

@section('title', 'Tienda Online')

@section('header')
    @parent
@stop

@section('includes')
    <script type="text/javascript" src="{{ URL::asset('js/header.js') }}"></script>
@stop

@section('content')
    @section('banner')
        <div>
            <img src="images/banner1.jpg" width="100%" height="250px">
        </div>
    @show
@stop