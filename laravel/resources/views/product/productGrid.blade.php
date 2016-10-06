<div id="image{{$product->id}}" class="undarkenImage" align="center"
     onmouseout="onProductOut('{{$product->name}}','{{$product->id}}')"
     onmouseover="onProductOver('{{$product->name}}','{{$product->id}}')"
     onclick="insertBasketProduct('{{$product->id}}','{{$product->name}}','{{$product->description}}','uploads/{{$product->image}}')">
    <img src="uploads/{{ $product->image }}" width="200" height="200">
    {{ $product->image }}
</div>
