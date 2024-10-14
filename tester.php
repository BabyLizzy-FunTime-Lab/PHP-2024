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
<section>
    <header>
        <h2>Variables</h2>
    </header>
    <?php
    $username = "Bob";
    echo "Username: " . $username . "<br>";
    $varTest = $username;
    echo "VarTest: " .  $varTest . "<br>";
    $username = "Joe";
    echo "Changed username: " . $username . "<br>";
    echo "Check varTest: " . $varTest . "<br>";
    $numberOne = 2;
    $numberTwo = 2;
    $sumOfNumbers = $numberOne + $numberTwo;
    echo "Result of sum: " . $sumOfNumbers;
    ?>
</section>
<section>
    <header>
        <h2>Arrays</h2>
    </header>
    <?php
    $testArray = array("bob", "bro", "derp", "Earl");
    echo "$testArray[1]";
    ?>
</section>

</body>

</html>


