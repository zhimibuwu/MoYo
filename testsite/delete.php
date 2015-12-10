<html>
	<head>
		<title>Delete</title>
	</head>
	<body>
<?php
session_start();

require 'db.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or 
    die ('Unable to connect. Check your connection parameters.');
mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

$query = "SELECT 
			MoYo_site_user.user_id AS userid
		FROM 
			MoYo_site_user
		WHERE MoYo_site_user.username = '" . $_SESSION['username'] . "' ";
$result = mysql_query($query, $db) or die(mysql_error($db));
$row = mysql_fetch_array($result);

$q = "DELETE FROM
		MoYo_site_user_playlistsongs
      WHERE
        user_id = '" .$row[0]. "' AND track_id ='" .$_GET['id']. "' ";

if (isset($q)) 
{
    $res = mysql_query($q, $db) or die(mysql_error($db));
}
echo "<p> You've successfully delete a record from your musiclist! </p>";
?>

<p>Return to my <a href="showplaylist.php">Musiclist</a></p>
</body>
</html>