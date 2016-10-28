<div id="productBasket" class="productBasketGeneralDiv w3-card-4" style="display: none">
    <div class="productBasketImageDiv">
        <img id="productImage" src="../uploads/}}" width="100" height="110" />
    </div>
    <div class="productBasketNameCheckoutDiv">
        <div id="productMainPageName">
            product name
        </div>
        <div id="productMainPageDescription" class="productGridDescriptionDiv">
            small description
        </div>
        <div class="productOptionsDiv">
            <div class="productOptionsIncrementerDiv">
                @include('not-logged.basket.basketProductIncrementer')
            </div>
            <div class="productOptionsIncrementerDiv">
                <div class="myStoreDropDownDiv">
                    <div class="dropdown">
                        <button id="productGridSize" class="dropbtn" value="M">Talla</button>
                        <div id="dropdownContent" class="dropdown-content">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="productBasketDeleteDiv" class="productBasketDeleteDiv">
        x
    </div>
</div>
