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

        <div class="checkoutTotalPaymentTextDiv" style="margin-top: 5px;">
            Subtotal :
        </div>
        <div class="checkoutSubtotalPaymentNumberDiv" id="checkoutSubtotalPayment">
            25000
        </div>

        <br/><br/>

        <div class="checkoutTotalPaymentTextDiv">
            Descuentos :
        </div>
        <div class="checkoutDiscountPaymentNumberDiv" id="checkoutDiscountPayment">
            -20000
        </div>

        <br/><br/>

        <div class="checkoutTotalPaymentTextDiv">
            Envio :
        </div>
        <div class="checkoutFreePaymentNumberDiv" id="checkoutShipping">
            GRATIS
        </div>

        <br/>

        <div class="checkoutHorizontalSeparatorDiv">
        </div>
        <br/>

        <div class="checkoutTotalPaymentTextDiv" style="font-size: 14px;font-weight: bold;">
            Total :
        </div>
        <div class="checkoutTotalPaymentNumberDiv" id="checkoutTotalPayment">

        </div>

        <br/><br/>

    </div>
    <div id="finalPayDiv" class="finalPaymentDiv w3-card-2 w3-hover-shadow w3-center">
        <input id="finalPayButton" hidden type="button" value="PAGAR"/>

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
    updateTotalCheckoutPrice();
</script>