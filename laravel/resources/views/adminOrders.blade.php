<html>

   <head>
      <title>Admin Orders</title>
   </head>
   <body>

      Admin Orders

      <div class="container">
        @foreach ($orders as $order)
            {{ $order->id }} {{$order->user->name}}
            <br>
        @endforeach
      </div>
      {{ $orders->links() }}
   </body>
</html>
