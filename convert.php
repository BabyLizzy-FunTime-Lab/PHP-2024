<?php
include 'sanitize.php';

$fahrenheit = '';
$celsius = '';

if (isset($_POST['F'])) $fahrenheit = sanitizeString($_POST['F']);
if (isset($_POST['C'])) $celsius = sanitizeString($_POST['C']);

if (is_numeric($fahrenheit)) {
    $celsius = intval( (5/9) * ($fahrenheit - 32));
    $result = "$fahrenheit &deg;c equals $celsius &deg;c";
} elseif (is_numeric($celsius)) {
    $fahrenheit = intval( (9/5) * ($celsius + 32));
    $result = "$celsius &deg;c equals $fahrenheit &deg;c";
} else $result = '';

echo <<<_END
<html>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Temperature Converter</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style/main.css">
        <link rel="stylesheet" type="text/css" href="style/normalize.css">
    </head>
    <body>
    <header>
        <h1>Temperature Converter</h1>
        <a href="http://localhost/PHP-2024/">Home</a> |
        <a href="http://localhost/PHP-2024/tester.php">Test Environment</a> |
        <a href="http://localhost/PHP-2024/convert.php">Temp converter</a> | 
        <a href="http://localhost/PHP-2024/authenticate.php">Authenticate</a> |
        <a href="http://localhost/PHP-2024/login&Forms.php">Login & Forms</a> |
    </header>
        <pre>
            Enter either Fahrenheit or Celsius and click to convert.
            <b>$result</b>
            <form method="post" action="convert.php">
                <label for="F">Fahrenheit</label>
                <input type="text" name="F" size="7">
                <label for="C">Celsius</label>
                <input type="text" name="C" size="7">
                <input type="submit" value="Convert">
            </form>
        </pre>
    </body>
</html>
_END;
