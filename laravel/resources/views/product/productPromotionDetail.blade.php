@extends('not-logged.mainStoreTemplate')

@section('mainTitle', 'checkout')

@section('mainHeader')
@include('not-logged.checkout.headerCheckout')
@stop

@section('mainContent')
        <!-- Modal content -->
<div style="width: 96%" class="w3-modal-content">

    <div class="w3-container">

        <div class="productDialogColDescription">
            <div class="productDialogSmallDescription" id="detailProductDialogProductSmallDescription">
                {{$product->small_description}}
            </div>
            <br/><br/>

            <div class="productDialogDescription" id="detailProductDialogProductDescription">
                {{$product->description}}
            </div>
        </div>

        <div class="productDialogColImage">
            <div>
                <img class="w3-card-2" id="detailProductDialogProductImage" src="/uploads/{{$product->image}}"
                     width="275"
                     height="350">
            </div>
            <br/>
            <br/>

        </div>
        <div class="productDialogColName">
            <div id="detailProductDialogName" class="productDialogNameDiv">
                {{$product->name}}
            </div>
            <br/><br/>

            @if($product->has_discount == 1)
                <div id="detailProductDialogDiscount" class="productDialogDiscountDiv">
                    Antes $ {{$product->price}} COP
                </div>
                <div id="detailProductDialogPrice" class="productDialogPriceDiv">
                    Ahora $ {{$product->price - $product->discount}} COP
                </div>
                <div id="detailProductDialogDiscountPercentage" class="productDialogDiscountPercentageDiv">
                    - {{$product->discountPercentage}} %
                </div>
            @else
                <div id="detailProductDialogPrice" class="productDialogPriceDiv">
                    Precio $ {{$product->price}} COP
                </div>
            @endif

            <br/>
            <br/>

            <div class="productDialogSizeDiv">
                Talla
            </div>
            <br/>
            <br/>

            <div id="productDialogSizeS" class="buttonSize w3-card-2 w3-hover-shadow w3-center"
                 onclick="onProductDialogSizeSelected('S')">
                <div>
                    S
                </div>
            </div>
            <div id="productDialogSizeM" class="buttonSize w3-card-2 w3-hover-shadow w3-center"
                 onclick="onProductDialogSizeSelected('M')">
                <div>
                    M
                </div>
            </div>
            <div id="productDialogSizeL" class="buttonSize w3-card-2 w3-hover-shadow w3-center"
                 onclick="onProductDialogSizeSelected('L')">
                <div>
                    L
                </div>
            </div>
            <br/><br/>

            <div class="detailProductDialogButtonAddToCart w3-card-2 w3-hover-shadow w3-center"
                 onclick="addProductToBasketFromPromotionDetail('{{$product}}');">
                Pagar
            </div>

        </div>

    </div>

    <div style="height: 25px">

    </div>

</div>
@stop
