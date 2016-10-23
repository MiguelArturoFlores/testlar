<div id="productGrid{{$product->id}}" class="productGridDiv" align="center">
    <div id="productGridCard{{$product->id}}" class="productGridCardDiv w3-card-8" align="center">
        <img src="../uploads/{{ $product->image }}" width="220" height="270"
             onclick="showDetailProduct({{$product}})">

        <div class="productGridDetailButton w3-hover-shadow w3-center"
             onclick="showDetailProduct({{$product}})">
            Detallar
        </div>

        <div class="myStoreDropDownDiv">
            <div class="dropdown">
                <button id="productGridSize{{$product->id}}" class="dropbtn" value="M">Talla M</button>
                <div class="dropdown-content">
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
                 onclick="addProductToBasketCheckout('{{$product}}')">
                <div class="buyButtonTextDiv">
                    Comprar
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
