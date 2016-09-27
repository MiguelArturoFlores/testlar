<html>

   <head>
      <title>Admin Orders</title>
   </head>
   <body>

      Admin Detail Ordes

      <div class="container">
            {{ $order->id }} {{$order->user->name}}
            <br>
            @foreach ($order->products as $product)
                {{ $product->name }}
                <br>
            @endforeach
      </div>



   </body>
</html>
