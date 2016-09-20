<html>

   <head>
      <title>Form Example</title>
   </head>

   <body>
      <form action = "/user/register" method = "post">
         <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
      
         <table>
            <tr>
               <td>Name</td>
               <td><input type = "text" name = "name" /></td>
            </tr>

            <tr>
               <td>last name</td>
               <td><input type = "text" name = "lastname" /></td>
            </tr>
         
            <tr>
               <td>address</td>
               <td><input type = "text" name = "address" /></td>
            </tr>

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
                  <input type = "submit" value = "Register" />
               </td>
            </tr>
         </table>
      
      </form>
   
   </body>
</html>