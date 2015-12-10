<?php
require 'db.inc.php';

$db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or 
    die ('Unable to connect. Check your connection parameters.');
mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

// create the comic_character table
$query = 'CREATE TABLE IF NOT EXISTS MoYo_album (
        Album_id  INTEGER UNSIGNED     NOT NULL AUTO_INCREMENT, 
        Name         VARCHAR(80)          NOT NULL DEFAULT "",
        Artist_id     INTEGER UNSIGNED     NOT NULL DEFAULT "",
        Genre_id       INTEGER UNSIGNED     NOT NULL DEFAULT 0,

        PRIMARY KEY (Album_id)
    ) 
    ENGINE=MyISAM';
mysql_query($query, $db) or die (mysql_error($db));

// create the comic_power table
$query = 'CREATE TABLE IF NOT EXISTS comic_power (
        power_id  INTEGER UNSIGNED NOT NULL AUTO_INCREMENT, 
        power     VARCHAR(40)      NOT NULL DEFAULT "",

        PRIMARY KEY (power_id)
    ) 
    ENGINE=MyISAM';
mysql_query($query, $db) or die (mysql_error($db));

// create the comic_character_power linking table
$query = 'CREATE TABLE IF NOT EXISTS comic_character_power (
        character_id  INTEGER UNSIGNED NOT NULL DEFAULT 0,
        power_id      INTEGER UNSIGNED NOT NULL DEFAULT 0,

        PRIMARY KEY (character_id, power_id)
    ) 
    ENGINE=MyISAM';
mysql_query($query, $db) or die (mysql_error($db));

// create the comic_lair table
$query = 'CREATE TABLE IF NOT EXISTS comic_lair (
        lair_id     INTEGER UNSIGNED NOT NULL AUTO_INCREMENT, 
        zipcode_id  CHAR(5)          NOT NULL DEFAULT "00000",
        address     VARCHAR(40)      NOT NULL DEFAULT "",

        PRIMARY KEY (lair_id)
    ) 
    ENGINE=MyISAM';
mysql_query($query, $db) or die (mysql_error($db));

echo 'Done.';
?>