<html>

   <head>
      <title>Login Example</title>
   </head>

   <body>
      <form action = "/login" method = "post">
         <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
      
         <table>
            <tr>
               <td>email</td>
               <td><input type = "text" name = "email" /></td>
            </tr>
            <tr>
               <td>Password</td>
               <td><input type = "password" name = "password" /></td>
            </tr>
         
            <tr>
               <td colspan = "2" align = "center">
                  <input type = "submit" value = "Login" />
               </td>
            </tr>
         </table>
      
      </form>
   
   </body>
</html>