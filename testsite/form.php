<html>
 <head>
  <title>Multipurpose Form</title>
  <style type="text/css">
  <!--
td {vertical-align: top;}
  -->
  </style>
 </head>
 <body>
  <h1> Please enter the info you hope to search! </h1>
  <form action="formprocess.php" method="post">
   <table>
    <tr>
     <td>Name</td>
     <td><input type="text" name="name" /></td>
    </tr><tr>
     <td>Item Type</td>
     <td>
      <input type="radio" name="type" value="album" checked="checked" /> Album <br/>
      <input type="radio" name="type" value="track" /> Track<br/>
      <input type="radio" name="type" value="artist"/> Artist<br/>
     </td>
    </tr><tr>
     <td>Genre<br/><small>(if applicable)</small></td>
     <td>
      <select name="movie_type">
       <option value="">Select a genre...</option>
       <option value="pop">Pop</option>
       <option value="alternative">Alternative</option>
       <option value="rnb">R&B/Soul</option>
       <option value="poprock">Pop/Rock</option>
       <option value="soundtrack">Soundtrack</option>
       <option value="Other">Other...</option>
      </select>
     </td>
    </tr><tr>
     <td> </td>
     <!-- <td><input type="checkbox" name="debug" checked="checked" /> -->
      <!-- Display Debug info -->
     <!-- </td> -->
    </tr><tr>
     <td colspan="2" style="text-align: center;">
      <input type="submit" name="submit" value="Search" /> 
      <!-- <input type="submit" name="submit" value="Add" /> -->
     </td>
    </tr>
   </table>
  </form>
  <p>Return to <a href="main.php">Home Page</a></p>
</body>
</html>
 </body>
</html>