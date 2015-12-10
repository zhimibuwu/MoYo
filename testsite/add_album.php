<?php
require 'db.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or 
  die ('Unable to connect. Check your connection parameters.');
mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

?>

<html>
  <head>
 	<title>Add Album</title>
  </head>
  <body>
  	<form action="success_album.php" method="post">
  		<table>
  			<tr>
  				<td>Album Name</td>
  				<td><input type="text" name="album_name"/></td>
          <td>Artist Name</td>
          <td><input type="text" name="artist_foreign_name"/><td>
          <td>Genre</td>
          <td><select name="genre">
            <?php
              $query = 'SELECT Genre_id, Name FROM MoYo_genre';

              $result = mysql_query($query, $db) or die(mysql_error($db));

              while ($row = mysql_fetch_array($result)) {
                foreach ($row as $value) {
                  echo '<option value=" '. $row['Genre_id'] . ' ">';
                  echo $row['Name']. '</option>';
                }
              }
            ?>
          </select></td>
  			</tr><tr>
  			<td colspan="2" style="text-align: center;">
  				<input type="submit" name="submit" value="Add"/>
  			</td>
  		</tr>
  	</table>

    <p>Return to <a href="form.php">Search</a></p>
    <p>Return to <a href="main.php">Home Page</a></p>
    <p>Return to my <a href="showplaylist.php">Musiclist</a></p>
  </body>
 </html>
