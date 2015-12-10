<?php
 require 'db.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or 
	die ('Unable to connect. Check your connection parameters.');
mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

 $query = "SELECT
        MoYo_album.Name AS albumname, MoYo_track.Name AS trackname, MoYo_track.Playtime AS playtime, MoYo_artist.Name AS artistname,  MoYo_genre.Name AS genrename
    FROM
        MoYo_track, MoYo_album, MoYo_genre, MoYo_artist
    WHERE
        MoYo_track.Artist_id = MoYo_artist.Artist_id AND MoYo_track.Album_id = MoYo_album.Album_id AND MoYo_track.Genre_id = MoYo_genre.Genre_id AND MoYo_track.Track_id = '" .$_GET['id']. "'
        ";

$result = mysql_query($query,$db) or die(mysql_error($db));
extract(mysql_fetch_array($result));
?>

<html>
<head>
	<title> Edit Track info </title>
</head>
<body>
	<form action="edit_success.php" method="post">
		<?php 
			session_start();

			$_SESSION['track_id'] = $_GET["id"]; 
		?>
		<table>
			<tr>
				<td>Track Name</td>
				<td><input type="text" name="track_name" value="<?php echo $trackname?>"/></td>
				<td>Playtime<td>
				<td><input type="time" name="track_playtime" value="<?php echo $playtime?>"/></td>
				<td>Album Name</td>
				<td><input type="text" name="album_foreign_name" value="<?php echo $albumname?>"/></td>
				<td>Artist Name</td>
				<td><input type="text" name="artist_foreign_name" value="<?php echo $artistname?>"/></td>
				<td>Genre</td>
				<td><select name="genre">
            <?php
              $query = 'SELECT Genre_id, Name FROM MoYo_genre';

              $result = mysql_query($query, $db) or die(mysql_error($db));

              while ($row = mysql_fetch_array($result)) {
                foreach ($row as $value) {
                  echo '<option value=" '. $row['Genre_id'] . ' ">';
                  echo $row['genrename']. '</option>';
                }
              }
            ?>
          </select></td>
  			</tr><tr>
  			<td colspan="2" style="text-align: center;">
  				<input type="submit" name="submit" value="Submit"/>
  			</td>
  		</tr>
  	</table>
    <p>Return to <a href="form.php">Search</a></p>
  <p>Return to <a href="main.php">Home Page</a></p>
  <p>Return to my <a href="showplaylist.php">Musiclist</a></p>
  </body>
 </html>