<a href="/">
    <div style="width: 20%; display: inline-block; background-color: #2ab27b; text-align: center;">
        tienda
    </div>
</a>

<a href="/contacto">
    <div style="width: 20%; display: inline-block; background-color: #2ab27b; text-align: center;">
        Contactanos
    </div>
</a>

<a href="/nosotros">
    <div style="width: 20%; display: inline-block; background-color: #2ab27b; text-align: center;">
        Acerca de Nosotros
    </div>
</a>

<div style="width: 20%; display: inline-block; background-color: #2ab27b; text-align: center;">
    <form action="/logout" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
        <input type="submit" value="Logout"/>
    </form>
</div>

<div style="width: 15%; display: inline-block;">
    <div id="buttonBasket" class="buttonShoppingCar" onclick="openBasketButton()">

    </div>
</div>