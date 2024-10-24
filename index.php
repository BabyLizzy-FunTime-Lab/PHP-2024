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
<!DOCTYPE html>
<html lang="en">
<head>
    <title>BMI Calculator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header>
    <h2>BMI</h2>
</header>
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
</body>
