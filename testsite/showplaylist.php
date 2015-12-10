<?php

session_start();

?>

<html>
 <head>
  <title>Logged In</title>
 </head>
 <body>
 	<p>This is your music list, <b><?php echo $_SESSION['username'];?>.</b></p> 

<?php

require 'db.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or 
  die ('Unable to connect. Check your connection parameters.');
mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

$query = "SELECT
        MoYo_track.Track_id AS trackid, MoYo_artist.Name, MoYo_track.Name, MoYo_track.Playtime,  MoYo_album.Name, MoYo_genre.Name
    FROM
        MoYo_track, MoYo_album, MoYo_genre, MoYo_artist, MoYo_site_user_playlistsongs, MoYo_site_user
    WHERE
        MoYo_track.Artist_id = MoYo_artist.Artist_id AND MoYo_track.Album_id = MoYo_album.Album_id AND MoYo_track.Genre_id = MoYo_genre.Genre_id AND MoYo_track.Track_id = MoYo_site_user_playlistsongs.Track_id AND MoYo_site_user_playlistsongs.user_id = MoYo_site_user.user_id AND MoYo_site_user.username = '" .$_SESSION['username']. "'
        ";

$result = mysql_query($query, $db) or die(mysql_error($db));

// show the results
echo '<table border="1">';
while ($row = mysql_fetch_array($result)) {
    echo '<tr>';
    foreach ($row as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '<td>';
    echo '<a href="edit.php?id=' . $row['trackid'] . '">EDIT</a>';
    echo '</td><td>';
    echo '<a href="delete.php?id='. $row['trackid'] . ' ">DELETE</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
?>

<p>Return to <a href="main.php">Home Page</a></p>
</body>
</html>