<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP 2024</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" type="text/css" href="style/normalize.css">
</head>

<body>
<header>
    <h1>Sessions</h1>
    <a href="http://localhost/PHP-2024/">Home</a> |
    <a href="http://localhost/PHP-2024/tester.php">Test Environment</a> |
    <a href="http://localhost/PHP-2024/convert.php">Temp converter</a> |
    <a href="http://localhost/PHP-2024/authenticate.php">Authenticate</a> |
    <a href="http://localhost/PHP-2024/login&Forms.php">Login & Forms</a> |
</header>
<?php
require_once 'db/login_users_test.php';
include 'sanitize.php';

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
}
catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    $un_temp = sanitize($pdo, $_SERVER['PHP_AUTH_USER']);
    $pw_temp = sanitize($pdo, $_SERVER['PHP_AUTH_PW']);

    $query = "SELECT * FROM users WHERE name=$un_temp";
    $result = $pdo->query($query);

    if (!$result->rowCount()) die("User not found");

    $row = $result->fetch();
    $id = $row['id'];
    $name = $row['name'];
    $email = $row['email'];
    $password = $row['password'];

    if(password_verify(str_replace("'", "", $pw_temp), $password)) {
        session_start();
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $id;
        echo htmlspecialchars("Welcome $name. Your email is $email and your id is $id");
        die ("<p><a href='continue.php'>Click here to continue</a></p>");
    } else die ("Invalid input.");
}
else
{
    header('WWW-Authenticate: Basic realm="Restricted Area');
    header('HTTP/1.1 401 Unauthorized');
    die("Please enter your username and password.");
}

function sanitize($pdo, $str) {
    $str = htmlentities(($str));
    return $pdo->quote($str);
}
