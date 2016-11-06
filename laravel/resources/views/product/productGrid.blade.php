<div id="productGrid{{$product->id}}" class="productGridDiv" align="center">
    <div id="productGridCard{{$product->id}}" class="productGridCardDiv w3-card-8">
        <div style="height: 270px; width: 220px; position: relative;" align="left">
            <img style="position: absolute" src="../uploads/{{ $product->image }}" width="220" height="270"
                 onclick="showDetailProduct({{$product}},getProductListSize({{$product->id}}))">

            @if($product->is_new == 1)
                <img style="position: absolute; left: 190px;" src="../images/labelNew.png" width="30" height="30"/>
            @endif

            @if($product->has_discount == 1)
                <div style="position: absolute; left: 0px; top: 225px; left: 175px">
                    <img style="position: absolute;" src="../images/labelDiscount.png" width="45"
                         height="45"/>

                    <div id="labelProductDiscount{{$product->id}}"
                         style="position: absolute; width: 45px; top: 15px; text-align: center">
                        - {{$product->discountPercentage}} %
                    </div>
                </div>
            @endif

        </div>

        <div class="productGridDetailButton w3-hover-shadow w3-center">
            <a href="/store/product/{{$product->id}}">
                Detallar
            </a>
        </div>


        <div class="myStoreDropDownDiv">
            <div class="dropdown">
                <button id="productGridSize{{$product->id}}" class="dropbtn" value="M">Talla M</button>
                <div class="dropdown-content" style="z-index: 3">
                    <a onclick="changeProductSize('{{$product->id}}','S')">Talla S</a>
                    <a onclick="changeProductSize('{{$product->id}}','M')">Talla M</a>
                    <a onclick="changeProductSize('{{$product->id}}','L')">Talla L</a>
                </div>
            </div>
        </div>

        <div class="productGridNameDiv">
            {{$product->name}}
        </div>
        <div class="productGridDescriptionDiv">
            {{$product->small_description}}
        </div>
        <div id="productGridDiscount{{$product->id}}" class="productGridPriceDivGeneral">
            {{$product->discount}}
        </div>

        <div class="productGridPriceDivGeneral">
            <div id="productGridPrice{{$product->id}}" class="productGridPriceDiv">
                Precio: $ {{$product->price}} COP
            </div>
            <div id="productGridDiscountLabel{{$product->id}}" class="invisible">
                50%
            </div>
        </div>

        <div id="divProductGrid{{$product->id}}">
            <div class="productGridAddProductButton w3-card-2 w3-hover-shadow w3-center"
                 onclick="calculateProductListSelectedSize({{$product->id}}); addProductToBasketCheckout('{{$product}}')">
                <div class="buyButtonTextDiv">
                    Agregar
                </div>
                <div class="buyButtonImageDiv">
                    <img src="/images/shopIcon.png" width="30" height="30"/>
                </div>
            </div>
        </div>
    </div>
    <script>
        validateProductDiscount('{!! $product !!}');
    </script>
</div>
