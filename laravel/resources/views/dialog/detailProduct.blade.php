<div id="detailProductDialog" class="w3-modal">
    <!-- Modal content -->
    <div style="width: 75%" class="w3-modal-content">

        <header style="width: 100%; background-color: #222222" class="w3-container w3-card-2">
            <span onclick="closeDetailProductDialog()" style="color: white;" class="w3-closebtn">&times;</span>

            <div class="productDialogTitle" id="productDialogTitleDiv">
                Modal Header
            </div>
        </header>

        <div class="w3-container">

            <div class="productDialogColName">
                <div id="detailProductDialogName" class="productDialogNameDiv">
                </div>
                <br/><br/>

                <div id="detailProductDialogDiscount" class="productDialogDiscountDiv">
                </div>
                <div id="detailProductDialogPrice" class="productDialogPriceDiv">
                </div>
                <div id="detailProductDialogDiscountPercentage" class="productDialogDiscountPercentageDiv">
                </div>
                <br/>
                <br/>

                <div class="productDialogSizeDiv">
                    Talla
                </div>
                <br/>
                <br/>

                <div id="productDialogSize1" class="buttonSize w3-card-2 w3-hover-shadow w3-center"
                     onclick="onProductDialogSizeSelected('productDialogSize1')">
                    <div>
                        S
                    </div>
                </div>
                <div id="productDialogSize2" class="buttonSize w3-card-2 w3-hover-shadow w3-center"
                     onclick="onProductDialogSizeSelected('productDialogSize2')">
                    <div>
                        M
                    </div>
                </div>
                <div id="productDialogSize3" class="buttonSize w3-card-2 w3-hover-shadow w3-center"
                     onclick="onProductDialogSizeSelected('productDialogSize3')">
                    <div>
                        L
                    </div>
                </div>
                <br/><br/>

                <div class="detailProductDialogButtonAddToCart w3-card-2 w3-hover-shadow w3-center"
                     onclick="addProductToBasketFromDialog();">
                    Comprar
                </div>

            </div>
            <div class="productDialogColImage">
                <img class="w3-card-2" id="detailProductDialogProductImage" src="" width="275" height="350">
            </div>
            <div class="productDialogColDescription">
                <div class="productDialogSmallDescription" id="detailProductDialogProductSmallDescription">
                </div>
                <br/><br/>

                <div class="productDialogDescription" id="detailProductDialogProductDescription">
                </div>
            </div>

        </div>

        <div style="height: 25px">

        </div>
    </div>
</div>