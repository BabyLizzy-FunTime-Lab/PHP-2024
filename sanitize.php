<?php
function sanitizeString($input) {
    $input = stripslashes($input);
    $input = strip_tags($input);
    $input = htmlentities($input);
    return $input;
}

function sanitizeMySQL($pdo, $input) {
    $input = $pdo->quote($input);
    $input = sanitizeString($input);
    return $input;
}
?>
