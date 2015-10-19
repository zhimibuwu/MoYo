<?php
$db = mysql_connect('localhost','root','641207') or 
	die ('Unable to connect. Check your connection parameters.');

$query = 'CREATE DATABASE IF NOT EXISTS moviesite';
mysql_query($query, $db) or die(mysql_error($db));

mysql_select_db('moviesite',$db) or die(mysql_error($db));

$query = 'INSERT INTO movie 
		(movie_id, movie_name, movie_type, movie_year, movie_leadactor,
		movie_director)
	VALUES
		(1, "Bruce Almighty", 5, 2003, 1, 2),
		(2, "office space", 5, 1999, 5, 6),
		(3, "Grand Canyon", 2, 1991, 4, 3)';

mysql_query($query, $db) or die (mysql_error($db));

$query = 'INSERT INTO movietype 
		(movietype_id, movietype_label)
	VALUES
		(1, "Sci Fi"),
		(2, "Drama"),
		(3, "Adventure"),
		(4, "War"),
		(5, "Comedy"),
		(6, "Horror"),
		(7, "Action"),
		(8, "Kids")';

mysql_query($query, $db) or die(mysql_error($db));

$query = 'INSERT INTO people 
		(people_id, people_fullname, people_isactor, people_isdirector)
	VALUES
		(1, "Jim Carrey", 1, 0),
		(2, "Tom Shadyac", 0, 1),
		(3, "Lawrence Kasdan", 0, 1),
		(4, "Kevin Kline", 1, 0),
		(5, "Ron Liveingston", 1, 0),
		(6, "Mike Judge", 0, 1)';

mysql_query($query, $db) or die(mysql_error($db));

echo 'Data inserted successfully!';
?>

