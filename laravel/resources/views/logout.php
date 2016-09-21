<html>

   <head>
      <title>Logout Example</title>
   </head>

   <body>
      <form action = "/logout" method = "post">
         <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">   
         <input type = "submit" value = "Logout" />
      </form>
   
   </body>
</html>