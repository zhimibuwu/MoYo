<?php
$db = mysql_connect('localhost','root','641207') or 
	die ('Unable to connect. Check your connection parameters.');

mysql_select_db('moviesite',$db) or die(mysql_error($db));

$query = 'SELECT
		movie_name, movie_type
		FROM 
			movie
		WHERE
			movie_year > 1990
		ORDER BY 
			movie_type';

$result = mysql_query($query, $db) or die(mysql_error($db));

echo '<table border="1">';
while ($row = mysql_fetch_assoc($result)) {
	echo '<tr>';
	foreach ($row as $value) {
		echo '<td>'  .  $value  .  '</td>';
	}
	echo '</tr>';
}
echo '</table>';
?>

