<html>

   <head>
      <title>Upload products</title>
   </head>

   <body>
      <form action = "/uploadProduct" method = "post" enctype="multipart/form-data">
         <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
      
         <table>
            <tr>
               <td>name</td>
               <td><input type = "text" name = "name" /></td>
            </tr>
            <tr>
               <td>description</td>
               <td><input type = "text" name = "description" /></td>
            </tr>
            <tr>
               <td>price</td>
               <td><input type = "number" name = "price" /></td>
            </tr>
            <tr>
               <td>Select image to upload:</td>
               <td><input type="file" name="image" id="image"></td>
            </tr>

            <tr>
               <td colspan = "2" align = "center">
                  <input type = "submit" value = "upload" />
               </td>
            </tr>

         </table>
      
      </form>
   
   </body>
</html>