<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP 2024</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/main.css">
</head>

<body>
<header>
    <h1>PHP 2024</h1>
</header>
<?php
$username = "Bob";
echo "Username: " . $username . "<br>";
$varTest = $username;
echo "VarTest: " .  $varTest . "<br>";
$username = "Joe";
echo "Changed username: " . $username . "<br>";
echo "Check varTest: " . $varTest;
?>
</body>

</html>


