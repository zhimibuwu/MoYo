<html>
      <head>
       <title>Character Database</title>
       <style type="text/css">
        th { background-color: #999; }
        td { vertical-align: top; }
        .odd_row { background-color: #EEE; }
        .even_row { background-color: #FFF; }
       </style>
      </head>
      <body>
<img src="http://2.bp.blogspot.com/-cqYKt0amXGw/VY8tNZvNPLI/AAAAAAAAFxY/KOLZuiPgaxA/s1600/netease.png" alt="Comic Book Appreciation Site" style="float: left; height: 90px; width: 160px" /> <h1>Comic Book<br/>Appreciation</h1>
<h2>Character Database</h2>
<hr style="clear: both;"/>
<?php
require 'db.inc.php';
      $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
          die ('Unable to connect. Check your connection parameters.');
      mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));
      // determine sorting order of table
      $order = array(1 => 'alias ASC',
                     2 => 'real_name ASC',
                     3 => 'alignment ASC, alias ASC');
      $o = (isset($_GET['o']) && ctype_digit($_GET['o'])) ? $_GET['o'] : 1;
      if (!in_array($o, array_keys($order))) {
$o = 1; }
      // select list of characters for table
      $query = 'SELECT
              character_id, alias, real_name, alignment
          FROM
              comic_character
          ORDER BY ' . $order[$o];
      $result = mysql_query($query, $db) or die (mysql_error($db));
      if (mysql_num_rows($result) > 0) {
          echo '<table>';
          echo '<tr><th><a href="' . $_SERVER['PHP_SELF'] . '?o=1">Alias</a></th>';
          echo '<th><a href="' . $_SERVER['PHP_SELF'] . '?o=2">Real Name</a></th>';
          echo '<th><a href="' . $_SERVER['PHP_SELF'] . '?o=3">Alignment</a></th>';
          echo '<th>Powers</th>';
          echo '<th>Enemies</th></tr>';
          $odd = true;    // alternate odd/even row styling
          while ($row = mysql_fetch_array($result)) {
echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">'; $odd = !$odd;
echo '<td><a href="edit_character.php?id=' . $row['character_id'] .
                  '">' . $row['alias'] . '</a></td>';
              echo '<td>' . $row['real_name'] . '</td>';
              echo '<td>' . $row['alignment'] . '</td>';
              // select list of powers for this character
              $query2 = 'SELECT
power FROM
                      comic_power p
                      JOIN comic_character_power cp
                          ON p.power_id = cp.power_id
                  WHERE
                      cp.character_id = ' . $row['character_id'] . '
                  ORDER BY
                      power ASC';
              $result2 = mysql_query($query2, $db) or die (mysql_error($db));
              if (mysql_num_rows($result2) > 0) {
                             $powers = array();
            while ($row2 = mysql_fetch_assoc($result2)) {
                $powers[] = $row2['power'];
            }
            echo '<td>' . implode(', ', $powers) . '</td>';
        } else {
            echo '<td>none</td>';
        }
        mysql_free_result($result2);
        // select list of rivalries for this character
        $query2 = 'SELECT
                c2.alias
            FROM
                comic_character c1
                JOIN comic_character c2
                JOIN comic_rivalry r
                    ON (c1.character_id = r.hero_id AND
                        c2.character_id = r.villain_id) OR
                       (c2.character_id = r.hero_id AND
                        c1.character_id = r.villain_id)
            WHERE
                c1.character_id = ' . $row['character_id'] . '
            ORDER BY
                c2.alias ASC';
        $result2 = mysql_query($query2, $db) or die (mysql_error($db));
        if (mysql_num_rows($result2) > 0) {
            $aliases = array();
            while ($row2 = mysql_fetch_assoc($result2)) {
                $aliases[] = $row2['alias'];
            }
            echo '<td>' . implode(', ', $aliases) . '</td>';
        } else {
            echo '<td>none</td>';
        }
        mysql_free_result($result2);
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p><strong>No Characters entered...</strong></p>';
} ?>
  <p><a href="edit_character.php">Add New Character</a></p>
  <p><a href="edit_power.php">Edit Powers</a></p>
 </body>
</html>