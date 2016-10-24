@extends('mainTemplate')

@section('title', 'Tienda Online')

@section('header')
    @parent
@stop

@section('content')
            <table width="100%">
                @foreach ($productList as $productRow)
                    <tr valign="top">
                        @foreach ($productRow as $product)
                            <td width="25%" style="padding-bottom: 25px">
                                @include('product.productGrid')
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
@stop
