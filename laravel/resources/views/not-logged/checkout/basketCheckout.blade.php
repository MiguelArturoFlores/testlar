<h2>4 Verifica tu Orden</h2>
<script>
    clearBasket();
</script>
@for ($i = 0; $i < count($productList); $i++)
    <script>
        addProductToBasketCheckout('{!! $productList[$i] !!}');
    </script>
@endfor

@for ($i = 0; $i < count($productList); $i++)
    <br/>
    @include('not-logged/basket/basketProduct')
    <br/>
@endfor

<br/>
<div class="checkoutTotalPaymmentDiv">

    <div class="checkoutTotalPaymmentTextDiv">
        Total Price :
    </div>
    <div class="checkoutTotalPaymmentNumberDiv" id="checkoutTotalPayment">

    </div>
</div>
<div id="finalPayDiv" class="finalPaymentDiv">
    <input id="finalPayButton" hidden type="button" value="PAGAR"/>
    <div id="textPay" style="padding-top: 20px">
        PAGAR
    </div>
</div>
<script>
    updateTotalCheckoutPrice();
</script>