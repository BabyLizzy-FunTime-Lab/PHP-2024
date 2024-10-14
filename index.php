<?php
$name = "José";
$lastName = "Rasmussen";
$color_favorite = "green";
$game_favorite = "Mass Effect Trilogy";
$dreamGuitar = "Fender Jag-Stang";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP 2024</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header>
    <h1>Hello World</h1>
</header>
<p>
    Full Name: <?php echo $name . " " . $lastName . "<br>"; ?>
    Favorite Color: <?php echo $color_favorite . "<br>" ?>
    Favorite Game: <?php echo $game_favorite . "<br>" ?>
    Dream Guitar: <?php echo $dreamGuitar ?>

</p>
</body>
</html>
