@extends('mainTemplate')

@section('title', 'Tienda Online')

@section('header')
    @parent
@stop

@section('content')
            <table width="100%">
                @foreach ($productList as $productRow)
                    <tr>
                        @foreach ($productRow as $product)
                            <td width="25%">
                                @include('product.productGrid')
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
@stop
