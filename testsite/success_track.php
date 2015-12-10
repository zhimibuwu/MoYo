<html>
	<head>
		<title>Commit</title>
	</head>
	<body>

		<?php


			require 'db.inc.php';

			$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or 
  				die ('Unable to connect. Check your connection parameters.');
			mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));


			$q = "SELECT 
			 		MoYo_artist.Artist_id 
			 	  FROM 
			 	  	MoYo_artist 
			 	  WHERE 
			 	  	MoYo_artist.Name = '" . $_POST['artist_foreign_name'] . "' ";
			
			$res = mysql_query($q, $db) or die(mysql_error($db)); 

			$row = mysql_fetch_array($res);

			$q1 = "SELECT 
			 		MoYo_album.Album_id 
			 	  FROM 
			 	  	MoYo_album 
			 	  WHERE 
			 	  	MoYo_album.Name = '" . $_POST['album_foreign_name'] . "' ";
			
			$res1 = mysql_query($q1, $db) or die(mysql_error($db)); 

			$row1 = mysql_fetch_array($res1);

			if (empty($row)) {
				echo "<p> No such artist right now. Please add the artist first! </p>";
			} else if (empty($row1)) {
				echo "<p> No such album right now. Please add the album first! </p>";
			}
			else {
				$query = 'INSERT INTO
					MoYo_track(Name, Playtime, Artist_id, Album_id, Genre_id)
        			VALUES
        				(" ' .$_POST['track_name']. ' ",
        				 "	' .$_POST['track_playtime'] . ' ",
        				" ' .$row[0]. ' ",
        				" ' . $row1[0] . ' ",
        				 ' . $_POST['genre'] . ')';
				if (isset($query)) {
        			$result = mysql_query($query, $db) or die(mysql_error($db));
        		}
        		echo "<p> You've successfully add a new track! </p>";
			}
			

		// echo $_POST['artist_name'];  
        
		?>

<P> Please click on this link to go back the main page! <a href="main.php"> Click Me! </a> </p>
</body>
</html>