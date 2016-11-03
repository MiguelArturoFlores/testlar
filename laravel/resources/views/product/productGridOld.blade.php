<div id="image{{$product->id}}" class="undarkenImage" align="center"
     onmouseout="onProductOut('{{$product->name}}','{{$product->id}}')"
     onmouseover="onProductOver('{{$product->name}}','{{$product->id}}')">
    <img src="../uploads/{{ $product->image }}" width="200" height="250"
         onclick="showDetailProduct({{$product}})">

    <div id="divProductGrid{{$product->id}}" class="invisible">
        <div class="productGridDetailButton" onclick="detailProductRedirect({{$product}})">
        </div>
        <div class="productGridAddProductButton"
             onclick="insertBasketProduct('{{$product}}')">
        </div>
    </div>
</div>