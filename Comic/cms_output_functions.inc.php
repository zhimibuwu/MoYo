<?php
// Return a string truncated to a maximum number of characters. If the string
// has been truncated, it will have $tail appended to the end.
function trim_body($text, $max_length = 500, $tail = '...') {
    $tail_len = strlen($tail);
    if (strlen($text) > $max_length) {
        $tmp_text = substr($text, 0, $max_length - $tail_len);
        if (substr($text, $max_length - $tail_len, 1) == ' ') {
            $text = $tmp_text;
        }
        else {
            $pos = strrpos($tmp_text, ' ');
            $text = substr($text, 0, $pos);
        }
        $text = $text . $tail;
    }
    return $text;
}

// Display an article from the database. 
function output_story($db, $article_id, $preview_only = FALSE) {
    if (empty($article_id)) {
        return;
    }
    $sql = 'SELECT
            name, is_published, title, article_text,
            UNIX_TIMESTAMP(submit_date) AS submit_date,
            UNIX_TIMESTAMP(publish_date) AS publish_date
        FROM
            cms_articles a JOIN cms_users u ON a.user_id = u.user_id
        WHERE
            article_id = ' . $article_id;
    $result = mysql_query($sql, $db) or die(mysql_error($db));

    if ($row = mysql_fetch_assoc($result)) {
        extract($row);
        echo '<h2>' . htmlspecialchars($title) . '</h2>';
        echo '<p>By: ' . htmlspecialchars($name) . '</p>';
        echo '<p>';
        if ($row['is_published']) {
            echo date('F j, Y', $publish_date);
        } else {
            echo 'Article is not yet published.';
        }
        echo '</p>';
        if ($preview_only) {
        echo '<p>' . nl2br(htmlspecialchars(trim_body($article_text))) . '</p>';
        echo '<p><a href="cms_view_article.php?article_id=' . $article_id . 
            '">Read Full Story</a></p>';
        } else {
            echo '<p>' . nl2br(htmlspecialchars($article_text)) . '</p>';
        }
    }
    mysql_free_result($result);
}

function show_comments($db, $article_id, $show_link = TRUE) {
    if (empty($article_id)) {
        return;
    }
    $sql = 'SELECT is_published FROM cms_articles WHERE article_id = ' . 
        $article_id;
    $result = mysql_query($sql, $db) or die(mysql_error($db));
    $row = mysql_fetch_assoc($result);
    $is_published = $row['is_published'];
    mysql_free_result($result);
    
    $sql = 'SELECT
            comment_text, UNIX_TIMESTAMP(comment_date) AS comment_date,
            name, email
        FROM
           cms_comments c LEFT OUTER JOIN cms_users u ON c.user_id = u.user_id
        WHERE
            article_id = ' . $article_id . '
        ORDER BY
            comment_date DESC';
    $result = mysql_query($sql, $db) or die(mysql_error($db));

    if ($show_link) {
        echo '<h3>' . mysql_num_rows($result) . ' Comments';
        if (isset($_SESSION['user_id']) and $is_published) {
            echo ' - <a href="cms_comment.php?article_id=' . $article_id .
                '">Add one</a>';
        }
        echo '</h3>';
    }

    if (mysql_num_rows($result)) {
        echo '<div>';
        while ($row = mysql_fetch_array($result)) {
            extract($row);
            echo '<span>' . htmlspecialchars($name) . '</span>';
            echo '<span> (' . date('l F j, Y H:i', $comment_date) . ')</span>';
            echo '<p>' . nl2br(htmlspecialchars($comment_text)) . '</p>';
        }
        echo '</div>';
    }
    echo '<br>';
    mysql_free_result($result);
}
?>