<script>
    clearBasket();
</script>
@for ($i = 0; $i < count($productList); $i++)
    <script>
        addProductToBasketCheckout('{!! $productList[$i] !!}');
    </script>
@endfor

<div class="checkoutRegisterInfoDiv">
    <div class="checkoutBuyProcessHeaderNumber">
        4.
    </div>
    <div class="checkoutBuyProcessHeaderText">
        Verifica tu Orden
    </div>
    <br/><br/>

    <div class="checkoutPayOrderGeneralDiv w3-card-2">

        @include('not-logged.checkout.basketCheckoutSummary')

        <br/><br/>

    </div>
    <div id="finalPayDiv" class="finalPaymentDiv w3-card-2 w3-hover-shadow w3-center" onclick="submitCheckoutInfoClick()">
        <div id="textPay" class="checkoutFinalPaymentTextDiv">
            PAGAR
        </div>
    </div>
    <div>
        <br/>
        @for ($i = 0; $i < count($productList); $i++)
            <br/>
            @include('not-logged/basket/basketProduct')
            <br/>
        @endfor
    </div>

</div>

<script>
    updateProductSizes();
    updateTotalCheckoutPrice();
</script>