<?php
function redirect($url) {
    if (!headers_sent()) {
        header('Location: ' . $url);
    } else {
        die('Could not redirect; Output was already sent to the browser.');
    }
}
?>