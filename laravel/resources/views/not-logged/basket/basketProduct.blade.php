<div class="productBasketGeneralDiv">
    <div class="productBasketImageDiv">
        <img src="../uploads/{{$productList[$i]->image}}" width="100" height="110" class="w3-card-2">
    </div>
    <div class="productBasketNameCheckoutDiv">
        {{$productList[$i]->name}}
        <div class="productGridDescriptionDiv">
            {{$productList[$i]->small_description}}
        </div>
        <div class="productOptionsDiv">
            <div class="productOptionsIncrementerDiv">
                @include('not-logged.basket.baskerProductIncrementer')
            </div>
            <div class="productOptionsIncrementerDiv">
                <div class="myStoreDropDownDiv">
                    <div class="dropdown">
                        <button id="productGridSize{{$productList[$i]->id}}" class="dropbtn" value="M">Talla M</button>
                        <div class="dropdown-content">
                            <a onclick="changeProductSize('{{$productList[$i]->id}}','S')">Talla S</a>
                            <a onclick="changeProductSize('{{$productList[$i]->id}}','M')">Talla M</a>
                            <a onclick="changeProductSize('{{$productList[$i]->id}}','L')">Talla L</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
