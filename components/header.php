<?php
function createHeader($title = "PHP 2025", $name = "PHP Project") :void
{
    echo <<<_END
<!DOCTYPE html>
<html lang="en">
<head>
    <title>$title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" type="text/css" href="style/normalize.css">
</head>

<body>
<header>
    <h1>$name</h1>
    <a href="http://localhost/PHP-2024/">Home</a> |
    <a href="http://localhost/PHP-2024/tester.php">Test Environment</a> |
    <a href="http://localhost/PHP-2024/convert.php">Temp converter</a> |
    <a href="http://localhost/PHP-2024/authenticate.php">Authenticate</a> |
    <a href="http://localhost/PHP-2024/login&Forms.php">Login & Forms</a> |
    <a href="http://localhost/PHP-2024/sessions.php">Sessions</a> |
    <a href="http://localhost/PHP-2024/readWriteText.php">Read & Write</a> |
</header>
_END;
}
