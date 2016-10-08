<div id="image{{$product->id}}" class="undarkenImage" align="center"
     onmouseout="onProductOut('{{$product->name}}','{{$product->id}}')"
     onmouseover="onProductOver('{{$product->name}}','{{$product->id}}')">
    <img src="uploads/{{ $product->image }}" width="200" height="200"
         onclick="insertBasketProduct('{{$product->id}}','{{$product->name}}','{{$product->description}}','uploads/{{$product->image}}')">

    <div id="divProductGrid{{$product->id}}" class="invisible">
        <div class="productGridDetailButton" onclick="showDetailProduct({{$product}})">
        </div>
        <div class="productGridAddProductButton"
             onclick="insertBasketProduct('{{$product->id}}','{{$product->name}}','{{$product->description}}','uploads/{{$product->image}}')">
        </div>
    </div>
</div>
