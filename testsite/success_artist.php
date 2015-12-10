<?php
require 'db.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or 
  die ('Unable to connect. Check your connection parameters.');
mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

?>
<html>
	<head>
		<title>Commit</title>
	</head>
	<body>
		<?php
			$query = "INSERT INTO
					MoYo_artist(Name)
        			VALUES
        				(' " .$_POST['artist_name']. "');
        		";

		// echo $_POST['artist_name'];  
        if (isset($query)) {
        	$result = mysql_query($query, $db) or die(mysql_error($db));
        }
		?>

<p> You've successfully add a new artist! </p>
<P> Please click on this link to go back the main page! <a href="main.php"> Click Me! </a> </p>
</body>
</html>