<?php
require 'db.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or 
  die ('Unable to connect. Check your connection parameters.');
mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

?>

<html>
  <head>
 	<title>Add Artist</title>
  </head>
  <body>
  	<form action="success_artist.php" method="post">
  		<table>
  			<tr>
  				<td>Artist Name</td>
  				<td><input type="text" name="artist_name"/></td>
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
