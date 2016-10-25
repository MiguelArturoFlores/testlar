<div style="width: 100%; display: inline-block">
    <div id="buttonCloseBasket" class="buttonCloseShoppingCar w3-card-2 w3-hover-shadow w3-center"
         onclick="closeBasket()">
        Seguir<br/>
        comprando
    </div>
    <div id="finalPayDiv" class="finalPaymentBasketDiv w3-card-2 w3-hover-shadow w3-center"
         onclick="checkoutBasket()">
        <input id="finalPayButton" hidden type="button" value="PAGAR"/>

        <div id="textPay" class="checkoutFinalPaymentTextDiv">
            PAGAR
        </div>
    </div>
</div>

<div id="basketProductList" class="basketProductList">

</div>

<div class="basketPayOrderGeneralDiv w3-card-4">

    @include('not-logged.checkout.basketCheckoutSummary')

    <br/><br/>

</div>

@include('not-logged.basket.basketProductMainPage')
