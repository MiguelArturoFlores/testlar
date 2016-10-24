<div class="headerMainDiv w3-card-2">
    <div class="headerLogoDiv">
        Bruno Hans
        <div class="headerLogoSubtitleDiv">
            Be different
        </div>
    </div>
    <div class="headerOptionsDiv">

        <div class="headerGeneralOptionDiv">
            <div class="freeShippingHeaderDiv">
                ENVIO GRATIS
            </div>
        </div>
        <div class="headerGeneralOptionDiv" style="width: 20%">
            <div class="headerLoginDiv">
                <div class="buttonLoginDiv w3-card-2 w3-hover-shadow w3-center">
                    <form action="/logout" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                        <input type="submit" value="Cerrar Session"/>
                    </form>
                </div>
                </a>
            </div>
        </div>
        <div class="headerGeneralOptionDiv" style="width: 12%">
            <div id="buttonBasket" class="headerBasketDiv w3-card-2 w3-hover-shadow w3-center"
                 onclick="openBasketButton()">
                <div id="buttonBasketText">
                    Carrito (0)
                </div>
                <div>
                    <img src="/images/shopIcon.png" width="30" height="30"/>
                </div>
            </div>
        </div>
        <div class="headerGeneralOptionDiv" style="width: 12%">
            <div id="buttonPay" class="headerCheckoutDiv w3-card-2 w3-hover-shadow w3-center"
                 onclick="checkoutBasket();">
                Pagar
                <div>
                    <img src="/images/payIcon.png" width="45" height="45"/>
                </div>
            </div>
        </div>


    </div>
</div>
