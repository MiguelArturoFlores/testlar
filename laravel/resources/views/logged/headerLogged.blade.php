<div class="headerMainDiv w3-card-2">
    <a href="/store">
        <div class="headerLogoDiv">
            Bruno Hans
            <div class="headerLogoSubtitleDiv">
                Be different
            </div>
        </div>
    </a>

    <div class="headerOptionsDiv">

        <div class="headerGeneralOptionDiv">
            <div class="freeShippingHeaderDiv">
                ENVIO GRATIS
            </div>
        </div>
        <div class="headerGeneralOptionDiv" style="width: 20%">
            <div class="headerLoginDiv">
                <div class="buttonLoginDiv w3-card-2 w3-hover-shadow w3-center" onclick="logoutPress()">
                    <form id="logoutForm" action="/logout" method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                        <div>
                            Cerrar Session
                        </div>
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
