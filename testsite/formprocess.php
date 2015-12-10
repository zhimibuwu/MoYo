<?php
// Make sure the user selected a movie type if they're adding a
// movie. If not, then send them back to the first form.
if ($_POST['submit'] == 'Add') {
    if ($_POST['type'] == 'movie' && $_POST['movie_type'] == '') {
        header('Location: additem.php');
    }        
}
?>
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
<?php
// Show a form to collect more information if the user is adding something
if ($_POST['submit'] == 'Add') {
    echo '<h1>Add ' . ucfirst($_POST['type']) . '</h1>';
?>
  <form action="additem.php" method="post">
   <input type="hidden" name="type" value="<?php echo $_POST['type']; ?>"/>
   <table>
    <tr>
     <td>Name</td>
     <td>
      <?php echo $_POST['name']; ?>
      <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>"/>
     </td>
    </tr>
<?php
    if ($_POST['type'] == 'movie') {
?>
    <tr>
     <td>Movie Type</td>
     <td>
      <?php echo $_POST['movie_type']; ?>
      <input type="hidden" name="movie_type"
       value="<?php echo $_POST['movie_type']; ?>"/>
     </td>
    </tr><tr>
     <td>Year</td>
     <td><input type="text" name="year" /></td>
    </tr><tr>
     <td>Movie Description</td>
<?php
    } else {
        echo '<tr><td>Biography</td>';
    }
?>
     <td><textarea name="extra" rows="5" cols="60"></textarea></td>
    </tr><tr>
     <td colspan="2" style="text-align: center;">
<?php
if (isset($_POST['debug'])) {
    echo '<input type="hidden" name="debug" value="on" />';
}
?>
      <input type="submit" name="submit" value="Add" />
     </td>
    </tr>
   </table>
  </form>
<?php
// The user is just searching for something
} else if ($_POST['submit'] == 'Search') {
    echo '<h1>Search for ' . ucfirst($_POST['type']) . '</h1>';
    echo '<p>The result for ' . $_POST['name'] . ' is below.</p>';

require 'db.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or 
  die ('Unable to connect. Check your connection parameters.');
mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

if ($_POST['type'] == 'artist')
{
  $query = "SELECT
        Track_id, MoYo_artist.Name, MoYo_track.Name, MoYo_track.Playtime,  MoYo_album.Name, MoYo_genre.Name
    FROM
        MoYo_track, MoYo_album, MoYo_genre, MoYo_artist
    WHERE
        MoYo_track.Artist_id = MoYo_artist.Artist_id AND MoYo_track.Album_id = MoYo_album.Album_id AND MoYo_track.Genre_id = MoYo_genre.Genre_id AND MoYo_artist.Name = '" .$_POST['name']. "'
        ";
}

else if ($_POST['type'] == 'album')
{
  $query = "SELECT
        Track_id, MoYo_album.Name, MoYo_track.Name, MoYo_track.Playtime, MoYo_artist.Name,  MoYo_genre.Name
    FROM
        MoYo_track, MoYo_album, MoYo_genre, MoYo_artist
    WHERE
        MoYo_track.Artist_id = MoYo_artist.Artist_id AND MoYo_track.Album_id = MoYo_album.Album_id AND MoYo_track.Genre_id = MoYo_genre.Genre_id AND MoYo_album.Name = '" .$_POST['name']. "'
        ";
}

else
{
  $query = "SELECT
        Track_id, MoYo_track.Name, MoYo_track.Playtime, MoYo_artist.Name, MoYo_album.Name, MoYo_genre.Name
    FROM
        MoYo_track, MoYo_album, MoYo_genre, MoYo_artist
    WHERE
        MoYo_track.Artist_id = MoYo_artist.Artist_id AND MoYo_track.Album_id = MoYo_album.Album_id AND MoYo_track.Genre_id = MoYo_genre.Genre_id AND MoYo_track.Name = '" .$_POST['name']. "'
        ";
}

$result = mysql_query($query, $db) or die(mysql_error($db));

// show the results
echo '<table border="1">';
while ($row = mysql_fetch_array($result)) {
    echo '<tr>';
    foreach ($row as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '<td>';
    echo '<a href="edit.php?id=' . $row['Track_id'] . '">EDIT</a>';
    echo '</td><td>';
    echo '<a href="favorite.php?id='. $row['Track_id'] . ' ">ADD TO MY LIST</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

}?>

  </br></br>
  <tr>
   <a href="add_track.php">Add New Track</a> </br>
   <a href="add_artist.php">Add New Artist</a> </br>
   <a href="add_album.php">Add New Album</a> </br>
   <a >
  </tr>

  <p>Return to <a href="form.php">Search</a></p>
  <p>Return to <a href="main.php">Home Page</a></p>
  <p>Return to my <a href="showplaylist.php">Musiclist</a></p>
  <!-- <input type="submit" name="submit" value="Edit existing tracks"> -->

<?php
if (isset($_POST['debug'])) {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
}
?>
 </body>
</html>