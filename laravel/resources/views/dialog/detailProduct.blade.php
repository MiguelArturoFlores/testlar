<div id="detailProductDialog" class="modal">

    <!-- Modal content -->
    <div class="modal-content1">
        <span class="close" onclick="closeDetailProductDialog()">x</span>
        <div style="width: 100%;">
            <div style="width: 45%; display: inline-block; vertical-align: top;">
                <img id="detailProductDialogProductImage" src="" width="200" height="200">
                <br/>

                <div id="detailProductDialogProductDescription">
                </div>
            </div >
            <div style="width: 45%; background-color: red; display: inline-block; vertical-align: top;">

                <input id="r1" type='radio' name='sizeChoice' value='S' >
                <label for="r1">S</label>

                <input id="r2" type='radio' name='sizeChoice' value='M'>
                <label for="r2">M</label>

                <input id="r3" type='radio' name='sizeChoice' value='XL'>
                <label for="r3">XL</label>
            </div>
        </div>
        <div style="text-align: center; width: 100%;">
            <div class="detailProductDialogButtonAddToCart" onclick="addProductToBasketFromDialog();">
                add to cart
            </div>
        </div>
    </div>

</div>