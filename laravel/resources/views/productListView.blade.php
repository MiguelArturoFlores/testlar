@extends('mainTemplate')

@section('title', 'Tienda Online')

@section('header')
    @parent
@stop

@section('content')
    <div>

        <div id="basketDiv" class="closeBasket">
            <div style="width: 100%">
                <div id="buttonCloseBasket" class="buttonCloseShoppingCar" onclick="closeBasket()">

                </div>
            </div>
            <div id="basketProductList" class="basketProductList">

            </div>

        </div>

        <div id="productListDiv" class="productListWithOutBasket">
            <table width="100%">
                @foreach ($productList as $productRow)
                    <tr>
                        @foreach ($productRow as $product)
                            <td width="25%">
                                <div id="image{{$product->id}}" class="undarkenImage" align="center"
                                     onmouseout="onProductOut('{{$product->name}}','{{$product->id}}')"
                                     onmouseover="onProductOver('{{$product->name}}','{{$product->id}}')"
                                     onclick="insertBasketProduct('{{$product->id}}','{{$product->name}}','{{$product->description}}','uploads/{{$product->image}}')">
                                    <img src="uploads/{{ $product->image }}" width="200" height="200">
                                    {{ $product->image }}
                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop