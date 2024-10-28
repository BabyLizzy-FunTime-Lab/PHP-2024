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
    <h1>Test Environment</h1>
    <a href="http://localhost/PHP-2024/">Home</a> |
    <a href="http://localhost/PHP-2024/tester.php">Test Environment</a>
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
<section>
    <header>
        <h2>Rekentabel</h2>
    </header>
    <?php
    function tableOfTen($multiplicatorLow, $multiplicatorHigh) {
        $resultsMemory = "";
        $tableColumns = $multiplicatorHigh - $multiplicatorLow + 1;
        echo "<tr><th class='mathTable__header' colspan='$tableColumns'>Multiplication by 10</th></tr>";
        for($base = 1; $base <= 10; $base++) {
            for ($multiplicator = $multiplicatorLow; $multiplicator <= $multiplicatorHigh; $multiplicator++) {
                $result = $base * $multiplicator;
                $resultsMemory = $resultsMemory . "<td class='mathTable__data'> $base x $multiplicator = $result </td>";
                if($multiplicator === 12) {
                    echo "<tr>$resultsMemory</tr>";
                    $resultsMemory = "";
                }
            }
        }
    }
    ?>
    <table class="mathTable">
        <?php
        tableOfTen(8, 12);
        ?>
    </table>
</section>
<section>
    <header>
        <h2>BMI</h2>
    </header>
    <?php
    function BMI($length) {
        // Weight is in kg.
        $minWeight = 40;
        $maxWeight = 150;
        echo "<tr>
                <th style='border-bottom: 2px solid black; text-align: left;'>
                    BMI overzicht bij een lengte van $length m
                </th>
            </tr>";
        for ($weight = $minWeight; $weight <= $maxWeight; $weight += 10) {
            $bmi = round($weight/(pow($length, 2)), 2);
            switch ($bmi) {
                case $bmi < 18.5:
                    $resultOfBmi = "ondergewicht";
                    break;
                case $bmi >= 18.5 && $bmi <= 24.9:
                    $resultOfBmi = "gezond gewicht";
                    break;
                case $bmi >= 25 && $bmi <= 30;
                    $resultOfBmi = "overgewicht";
                    break;
                case $bmi > 30:
                    $resultOfBmi = "obesitas";
                    break;
                default:
                    $resultOfBmi = "normaal gewicht";
            }
            echo "<tr>
                    <td>
                        Bij een gewicht van $weight kg is de BMI $bmi, $resultOfBmi
                    </td>
                </tr>";
        }
    }
    ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="length">
            Lengte in meters:
            <input name="length" class="inputField length" type="number" step="0.01">
        </label>
        <input type="submit" name="lengthBMI">
    </form>
    <table style="margin-top: 1em; margin-bottom: 3em;">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['lengthBMI'])) {
            $input_length = $_POST['length'];
            BMI($input_length);
        }
        ?>
    </table>
</section>
<section>
    <?php
    // This will display all info on the current php version and the server.
    // phpinfo();
    ?>
    <header>
        <h2>Functions and Objects</h2>
    </header>

</section>
</body>

</html>


