<?php
$db = mysql_connect('localhost','root','641207') or 
	die ('Unable to connect. Check your connection parameters.');

$query = 'CREATE DATABASE IF NOT EXISTS moviesite';
mysql_query($query, $db) or die(mysql_error($db));

mysql_select_db('moviesite',$db) or die(mysql_error($db));

$query = 'CREATE TABLE movie (
		movie_id            INTEGER UNSIGNED       NOT NULL AUTO_INCREMENT,
		movie_name	        VARCHAR(255)           NOT NULL,
		movie_type			TINYINT 			   NOT NULL DEFAULT 0,
		movie_year			SMALLINT			   NOT NULL DEFAULT 0,
		movie_leadactor     INTEGER UNSIGNED	   NOT NULL DEFAULT 0,
		movie_director		INTEGER UNSIGNED	   NOT NULL DEFAULT 0,

		PRIMARY KEY (movie_id),
		KEY movie_type (movie_type, movie_year)
	)
	ENGINE=MyISAM' ;

mysql_query($query, $db) or die (mysql_error($db));

$query = 'CREATE TABLE movietype (
		movietype_id		TINYINT UNSIGNED        NOT NULL AUTO_INCREMENT,
		movietype_label	    VARCHAR(100)            NOT NULL,
		PRIMARY KEY (movietype_id)
	)
	ENGINE=MyISAM';

mysql_query($query, $db) or die(mysql_error($db));

$query = 'CREATE TABLE people (
		people_id            INTEGER UNSIGNED       NOT NULL AUTO_INCREMENT,
		people_fullname		 VARCHAR(255)           NOT NULL,
		people_isactor       TINYINT(1) UNSIGNED	NOT NULL DEFAULT 0,
		people_isdirector	 TINYINT(1) UNSIGNED	NOT NULL DEFAULT 0,

		PRIMARY KEy (people_id)
	)
	ENGINE=MyISAM';

mysql_query($query, $db) or die(mysql_error($db));

echo 'Movie database successfully created!';
?>

