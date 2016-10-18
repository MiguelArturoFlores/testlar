<input type="button" value="-" onclick="onDecrementCheckoutBasketProduct('{{$productList[$i]->id}}')"/>
<input id="productQuantity{{$productList[$i]->id}}" value="{{$productList[$i]->quantity}}" type="text" size="1"
       readonly/>
<input type="button" value="+" onclick="onIncrementCheckoutBasketProduct('{{$productList[$i]->id}}')"/>

<div id="productPrice{{$productList[$i]->id}}">
    {{$productList[$i]->totalPrice}}
</div>