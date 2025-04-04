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
    <h1>Test Environment</h1>
    <a href="http://localhost/PHP-2024/">Home</a> |
    <a href="http://localhost/PHP-2024/tester.php">Test Environment</a> |
    <a href="http://localhost/PHP-2024/convert.php">Temp converter</a> |
    <a href="http://localhost/PHP-2024/authenticate.php">Authenticate</a> |
    <a href="http://localhost/PHP-2024/login&Forms.php">Login & Forms</a> |
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
            <input id="length" name="length" class="inputField length" type="number" step="0.01">
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
    <?php
    print_r("derp");
    ?>
</section>
<section>
    <?php
    function square($sideLength) {
        $width = $sideLength;
        $height = $sideLength;

        // Create a blank image.
        $image = imagecreatetruecolor($width, $height);

        // Set colors.
        // Set colors
        $backgroundColor = imagecolorallocate($image, 255, 255, 255); // White background
        $squareColor = imagecolorallocate($image, 0, 0, 0);           // Black square

        // Fill the background
        imagefill($image, 0, 0, $backgroundColor);

        // Draw a square
        $squareSize = 100;
        $x = ($width - $squareSize) / 2;
        $y = ($height - $squareSize) / 2;
        imagefilledrectangle($image, $x, $y, $x + $squareSize, $y + $squareSize, $squareColor);


        // Capture the output buffer
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();

        // Free memory
        imagedestroy($image);

        // Encode the image data as base64
        $base64 = base64_encode($imageData);

        // Output the image as a data URI
        echo '<img src="data:image/png;base64,' . $base64 . '" alt="Square Image" />';
    }

    ?>
    <h2>Pythagoras</h2>
    <?php
    square(200);
//    phpinfo();
    ?>
    <?php
    // Set the image dimensions
    $width = 200;
    $height = 200;

    // Create a blank image
    $image = imagecreatetruecolor($width, $height);

    // Set background color
    $backgroundColor = imagecolorallocate($image, 255, 255, 255); // White background
    imagefill($image, 0, 0, $backgroundColor);

    // Function to create and (optionally) rotate a square
    function createSquare($size, $angle, $color) {
        $squareImage = imagecreatetruecolor($size, $size);

        // Set transparent background for the square
        $transparent = imagecolorallocatealpha($squareImage, 0, 0, 0, 127);
        imagefill($squareImage, 0, 0, $transparent);
        imagesavealpha($squareImage, true); // Keep transparency

        // Draw the square
        imagefilledrectangle($squareImage, 0, 0, $size, $size, $color);

        // Rotate if an angle is specified
        if ($angle != 0) {
            $squareImage = imagerotate($squareImage, $angle, $transparent);
            imagesavealpha($squareImage, true); // Keep transparency after rotation
        }

        return $squareImage;
    }

    // Set colors for each square
    $squareColor1 = imagecolorallocate($image, 0, 0, 0);      // Black
    $squareColor2 = imagecolorallocate($image, 255, 0, 0);    // Red

    // Define size, angle, and position for each square
    $squareSize = 50;   // Size of each square

    // Create and position the first square
    $rotatedSquare1 = createSquare($squareSize, 0, $squareColor1); // No rotation
    $x1 = 75; // Position for first square
    $y1 = 125;
    imagecopy($image, $rotatedSquare1, $x1, $y1, 0, 0, imagesx($rotatedSquare1), imagesy($rotatedSquare1));

    // Calculate the size of the second square (rotated)
    $newSize = $squareSize * 0.707; // Approx. size for the next square
    // Calculate diagonal.
    $diagonalDistance = sqrt(pow($newSize, 2) + pow($newSize, 2));

    // Create and position the second square
    $x2 = $x1 - ($newSize * sqrt(2) / 2); // Horizontal adjustment
    $y2 = $y1 - ($newSize * sqrt(2) / 2) - ($diagonalDistance/2); // Vertical adjustment

    $rotatedSquare2 = createSquare($newSize, 45, $squareColor2); // 45-degree rotation
    imagecopy($image, $rotatedSquare2, $x2, $y2, 0, 0, imagesx($rotatedSquare2), imagesy($rotatedSquare2));

    // Capture the output buffer
    ob_start();
    imagepng($image);
    $imageData = ob_get_clean();

    // Free memory
    imagedestroy($image);
    imagedestroy($rotatedSquare1);
    imagedestroy($rotatedSquare2);

    // Encode the image data as base64
    $base64 = base64_encode($imageData);

    // Output the image as a data URI
    echo '<img src="data:image/png;base64,' . $base64 . '" alt="Two Squares Image" />';
    ?>
</section>
<section>
    <?php
    function reverseString($string) :void {
        echo strrev($string);
    }
    ?>
    <h2>String Reverse</h2>
    <p>
        Start string: 1234<br>
        End string: <?php reverseString("1234")?>
    </p>
</section>
<section>
    <?php
    function findFactorial($number){
        $factorial = 1;
        static $startNumber = 1;
        $startNumber = $number;
        static $loopNumber = 0;
        static $multiplier = 1;
        static $result = 1;

        if ($loopNumber > $startNumber) {
            echo $multiplier . "<br>";
            echo "Problem <br>";
            return;
        }

        if($startNumber == 0) {
            echo $result;
        }
        $multiplier += $factorial;
        $result = $result * $multiplier;
        $loopNumber++;
        if($startNumber === $multiplier) {
            echo $result;
        } else {
            findFactorial($number);
        }
    }
    ?>
    <h2>Factorial of 7 Recursive Function</h2>
    <p>
        <?php findFactorial(7); ?>
    </p>
</section>
<section>
    <h2>Practical PHP</h2>
    <?php
    printf("There are %d items in your basket",  3);
    echo "<br>";
    printf("There are %b items in your basket",  3);
    ?>
    <h3>File check and File creation</h3>
    <?php
    $fh = fopen( "textFileFolder/testFile.txt", 'w+') or die("Cloud not write to file");
    $text = <<<_END
Line 1
Line 2
Line 3
_END;
    fwrite($fh, $text) or die("Cloud not write to file");
    fclose($fh);
    echo "File 'textFileFolder/testFile.txt' written."
    ?>
    <p>
        <?php
        if(file_exists("textFileFolder/testFile.txt")) echo "File exists";
        else echo "File does not exist";
        ?>
    </p>
    <h3>Read File</h3>
    <p>
        Read one line: <br>
        <?php
        $fh = fopen("textFileFolder/testFile.txt", 'r') or die("File not found.");
        $line = fgets($fh);
        fclose($fh);
        echo $line;
        ?>
    </p>
    <p>
        Read select length: <br>
        <?php
        $fh = fopen("textFileFolder/testFile.txt", 'r') or die("File not found.");
        $text = fread($fh, 3);
        fclose($fh);
        echo $text;
        ?>
    </p>
    <p>
        Read all lines: <br>
        <?php
        $fh = fopen("textFileFolder/testFile.txt", 'r') or die("File not found.");
        if ($fh) {
            while (($line = fgets($fh)) !== false) {
                echo $line . "<br>"; // Echo each line with a line break
            }
            fclose($fh); // Close the file
        } else {
            echo "Error opening the file.";
        }
        ?>
    </p>
    <h3>Copy File</h3>
    <p>
        <?php
        if(!copy("textFileFolder/testFile.txt", "textFileFolder/testFile2.txt")) echo "Could not copy";
        else echo "File copied";
        ?>
    </p>
    <h3>Uploading Files</h3>
    <?php
    if($_FILES)
    {
        $imagePath = "uploads/" . $_FILES['filename']['name'];
        $name = $_FILES['filename']['name'];
        switch ($_FILES['filename']['type'])
        {
            case 'image/jpeg': $ext = 'jpg'; break;
            case 'image/gif': $ext = 'gif'; break;
            case 'image/png': $ext = 'png'; break;
            case 'image/tiff': $ext = 'tif'; break;
            default: $ext = ''; break;
        }
        if($ext)
        {
            move_uploaded_file($_FILES['filename']['tmp_name'], $imagePath);
            echo "Uploaded image '$name' <br> <img style='height: 15em' src='$imagePath'>";
        }
        else echo "Uploaded file is not an accepted image file.";
    }
    else echo "No image has been uploaded";
    ?>
    <form method="post" action="tester.php" enctype="multipart/form-data">
        Select aJPG, GIF, PNG or TIF File:
        <input type="file" name="filename" size="10"><br>
        <input type="submit" value="Upload">
    </form>
    <h2>System command</h2>
    <p>
    <?php
    $cmd = "dir";
    // $cmd = "ls"; //Linux, Unix, Mac
    exec(escapeshellcmd($cmd), $output, $status);
    if($status) echo "Exec command failed";
    else
    {
        echo "<pre>";
        foreach($output as $line) echo htmlspecialchars("$line\n");
        echo "</pre>";
    }
    ?>
    </p>
</section>
<section>
    <h2>Arrays Oefenopgave 1</h2>
    <p>
        <?php
        $colorsArray =["pink", "white", "black"];
        echo "Opgave 1: <br>";
        echo "Her hair was $colorsArray[1], her pants were $colorsArray[2] and her panties....$colorsArray[0].<br>"
        ?>
    </p>
    <p>
        <?php
        echo "Opgave 2: <br>";
        $cars = array (
            "Volvo" => array("color" => "Blue"),
            "Audi" => array("color" => "Green"),
            "BMW" => array("color" => "Yellow"),
            "Skoda" => array("color" => "yellow")
        );
        foreach ($cars as $car => $carData) {
            echo "<li>$car@$carData[color]</li>";
        }
        ?>
    </p>
</section>
<section>
    <h2>Arrays Oefenopgave 2</h2>
    <?php
    $score = 12344;
    $scoreBoard = (array) $score;
    echo "$scoreBoard[0]<br>";
    ?>
    <?php
    $time = strtotime('2004/01/01');
    echo "Date: " . date('H:\i:s', $time) . "<br>";
    ?>
</section>
<section>
    <h2>Emotional Bunnies</h2>
    <?php
    class BunnyFactory {
        private string $ears = "<code>&nbsp;()_()</code><br>";
        private string $feet = '<code>("")("")</code><br>';
        private string $emotion;
        private array $bunnyRecord = [];
        private function emotionSelect() :void {
            $emotions = array(
                "happy" => "&nbsp;(^.^)<br>",
                "surprised" => "&nbsp;(o.o)<br>",
                "angry" => "&nbsp;(@.@)<br>",
                "disappointed" => "&nbsp;(>.<)<br>",
                "inquisitive" => "&nbsp;(?.?)<br>",
                "thoughtful" => "&nbsp;(&.&)<br>"
            );
            $selectedEmotionName = array_rand($emotions);
            $selectedEmotion = $emotions[$selectedEmotionName];
            $this->emotion = "<code>" . $selectedEmotion . "</code>";
            $this->bunnyRecord[] = $selectedEmotionName;
        }
        public function generateBunny() :string {
            $this->emotionSelect();
            return $this->ears . $this->emotion . $this->feet;
        }
        public function getScores() :array {
            $score = 0;
            // First we calculate on what index the second row starts.
            $bunnyCount = count($this->bunnyRecord);
            $secondRowStartIndex = $bunnyCount/2;
            $secondRowIndex = $secondRowStartIndex;
            // Then compare top row to bottom row.
            for($recordIndex = 0; $recordIndex <= $secondRowStartIndex-1; $recordIndex++) {
                if($this->bunnyRecord[$recordIndex] === $this->bunnyRecord[$secondRowIndex]) {
                    // If top matches bottom we add to the score.
                    $score++;
                }
                // Then we move to the next column comparison.
                $secondRowIndex++;
            }
            // Save latest score result to text file. This should be a private method.
            $file = fopen( "bunnyScore.txt", 'a+') or die("Cloud not write to file");
            $textScore = "Score: " . $score . "\n";
            fwrite($file, $textScore) or die("Cloud not write to file");
            fclose($file);
            // Read all scores and store them in the scoreResults array. Private method.
            $scoreResults = [];
            $readFile = fopen("bunnyScore.txt", 'r') or die("File not found.");
            while (($recordedScore = fgets($readFile)) !== false) {
                $scoreResults[] = $recordedScore;
            }
            fclose($readFile); // Close the file
            // Returns all saved scores ready to be added to the bunnies table in an array.
            return $scoreResults;
        }
    }
    // Now we make a table of 10 bunnies and compare top to bottom row for score.
    function makeBunnyGroup($groupSize) :void {
        // The input number must be even.
        if($groupSize % 2 != 0) {
            echo "The number of bunnies must be even.";
            return;
        }
        $bunny = new BunnyFactory();
        $numberOfRows = 1;
        $columnsNeeded = $groupSize/2;
        // First we render the table header.
        echo "<tr><th colspan='$columnsNeeded'>Bunnies</th></tr>";
        // Then we render the rows with the bunnies.
        while ($numberOfRows <= 2) {
            echo "<tr>";
            for ($columns = 1; $columns <= $columnsNeeded; $columns++) {
                echo "<td class='mathTable__data'>" . $bunny->generateBunny() . "</td>";
                if($columns === $columnsNeeded) {
                    echo "</tr>";
                    $numberOfRows++;
                }
            }
        }
        // The scores are added to the bunnies table.
        $scoreResults = $bunny->getScores();
        $scoreResultsCount = count($scoreResults);
        $columnCount = 0;
        echo "<tr>";
        foreach ($scoreResults as $index => $score) {
            $columnCount++;
            if($index+1 === $scoreResultsCount) echo "<td class='mathTable__data'><strong>$score</strong></td>";
            else echo "<td class='mathTable__data'>$score</td>";
            if($columnCount === $columnsNeeded && $index+1 < $scoreResultsCount) {
                echo "</tr><tr>";
                $columnCount = 0;
            }
        }
        echo "</tr>";
    }
    ?>
    <table>
        <?php
        makeBunnyGroup(10);
        ?>
    </table>
</section>
<section>
    <h2>DB access PDO query</h2>
    <?php
    require_once 'db/login.php';
    try {
        $pdo = new PDO($attr, $user, $pass, $opts);
    }
    catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    ?>
    <?php
    $query = "SELECT * FROM classics";
    $result = $pdo->query($query);
    while ($row = $result->fetch())
    {
//        print_r($row);
        echo "<br>";
        echo 'Author:       ' . htmlspecialchars($row['author']) . "<br>";
        echo 'Title:        ' . htmlspecialchars($row['title']) . "<br>";
        echo 'Category:     ' . htmlspecialchars($row['category']) . "<br>";
        echo 'Year:         ' . htmlspecialchars($row['year']) . "<br>";
        echo 'ISBN:         ' . htmlspecialchars($row['isbn']) . "<br><br>";
    }
    // When it's done we choose to close the PDO connection manually.
    $pdo = null;
    ?>
</section>
<section>
    <h2>POST data to database</h2>
    <?php
    require_once 'db/login.php';

    try {
        $pdo = new PDO($attr, $user, $pass, $opts);
    }
    catch(PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    function get_post($pdo, $var)
    {
        return $pdo->quote($_POST[$var]);
    }

    if (isset($_POST['delete']) && isset($_POST['isbn']))
    {
        $isbn = get_post($pdo, 'isbn');
        $query = "DELETE FROM classics WHERE isbn=$isbn";
        $result = $pdo->query($query);
    }
    if (isset($_POST['author']) &&
        isset($_POST['title']) &&
        isset($_POST['category']) &&
        isset($_POST['year']) &&
        isset($_POST['isbn']))
    {
        $author = get_post($pdo, 'author');
        $title = get_post($pdo, 'title');
        $category = get_post($pdo, 'category');
        $year = get_post($pdo, 'year');
        $isbn = get_post($pdo, 'isbn');

        $query = "INSERT INTO classics VALUES" . "($author, $title, $category, $year, $isbn)";
        $result = $pdo->query($query);
    }

    echo <<<_END
    <form action="tester.php" method="post"><pre>
    Author <input type="text" name="author">
     Title <input type="text" name="title">
  Category <input type="text" name="category">
      Year <input type="text" name="year">
      ISBN <input type="text" name="isbn">
           <input type="submit" value="ADD RECORD">
    </pre></form>
_END;

    $query = "SELECT * FROM classics";
    $result = $pdo->query($query);
    while ($row = $result->fetch())
    {
        $r0 = htmlspecialchars($row['author']);
        $r1 = htmlspecialchars($row['title']);
        $r2 = htmlspecialchars($row['category']);
        $r3 = htmlspecialchars($row['year']);
        $r4 = htmlspecialchars($row['isbn']);
        echo <<<_END
<pre>
Author: $r0
Title: $r1
Category: $r2
Year: $r3
ISBN: $r4
</pre>
<form action='tester.php' method='post'>
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="isbn" value='$r4'>
<input type="submit" value="DELETE RECORD">
</form>
_END;
    }
    ?>
</section>
<section>
    <h2>Creating a new Table in db and manipulating the data.</h2>
    <img src="uploads/Demon_Succubus.png" height="200">
    <?php
//    require_once 'db/login.php';
//
//    try {
//        $pdo = new PDO($attr, $user, $pass, $opts);
//    }
//    catch (PDOException $e) {
//        throw new PDOException($e->getMessage(), (int)$e->getCode());
//    }

//    Make a new table.
//    $query = "CREATE TABLE cats (
//       id SMALLINT NOT NULL AUTO_INCREMENT,
//       family VARCHAR(32) NOT NULL,
//       name VARCHAR(32) NOT NULL,
//       age TINYINT NOT NULL,
//       PRIMARY KEY (id)
//    )";
//    $result = $pdo->query($query);

//    Populate table.
//    $query = "INSERT INTO cats VALUES(NULL, 'Lion', 'Leo', 4), (NULL, 'Cougar', 'Growler', 2), (NULL, 'Cheetah', 'Charly', 3)";
//    $result = $pdo->query($query);

//     Delete data
//    $query = "DELETE FROM cats WHERE name='Growler'";
//    $result = $pdo->query($query);

//     Add a new row and report the givin ID.
//    $query = "INSERT INTO cats VALUES(NULL, 'Lynx', 'Stumpy', 5)";
//    $result = $pdo->query($query);
//    echo "The Insert ID was: " . $pdo->lastInsertId();
    ?>
</section>
<section>
    <h2>Joining tables with queries.</h2>
    <p>This can also be done with a NATURAL JOIN</p>
    <?php
    require_once 'db/login.php';

    try {
        $pdo = new PDO($attr, $user, $pass, $opts);
    }
    catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $query = "SELECT * FROM customers";
    $result = $pdo->query($query);

    while($row = $result->fetch()) {
        $customerName = htmlspecialchars($row['name']);
        $customerISBN = htmlspecialchars($row['isbn']);

        echo "$customerName purchased ISBN $customerISBN: <br>";

        $subQuery = "SELECT * FROM classics WHERE isbn='$customerISBN'";
        $subResult = $pdo->query($subQuery);
        $subRow = $subResult->fetch();

        $customerBook = htmlspecialchars($subRow['title']);
        $customerAuthor = htmlspecialchars($subRow['author']);

        echo "&nbsp;&nbsp; '$customerBook' by $customerAuthor<br><br>";
    }
    ?>
</section>
<section>
    <h2>Hacking Security</h2>
    <img src="uploads/bouncer.jpg" height="200">
    <h3>Using Placeholders</h3>
    <?php
//    require_once 'db/login.php';
//
//    try {
//        $pdo = new PDO($attr, $user, $pass, $opts);
//    }
//    catch (PDOException $e) {
//        throw new PDOException($e->getMessage(), (int)$e->getCode());
//    }
//
//    $statement = $pdo->prepare('INSERT INTO classics VALUES(? ,? ,? ,?, ?)');
//
//    $statement->bindParam(1, $author, PDO::PARAM_STR, 128);
//    $statement->bindParam(2, $title, PDO::PARAM_STR, 128);
//    $statement->bindParam(3, $category, PDO::PARAM_STR, 16);
//    $statement->bindParam(4, $year, PDO::PARAM_INT);
//    $statement->bindParam(5, $isbn, PDO::PARAM_STR, 13);
//
//    $author = 'Emily Bronte';
//    $title = 'Wuthering Heights';
//    $category = 'Classic Fiction';
//    $year = '1847';
//    $isbn = '9780553212587';
//
//    $statement->execute([$author, $title, $category, $year, $isbn]);
//
//    printf("%d Row inserted.\n", $statement->rowCount());
    ?>
    <h3>Preventing JS injection</h3>
    <?php
    function mysql_fix_string($pdo, $string) {
        // This is deprecated //
        // if (get_magic_quotes_gpc()) $string = stripslashes($string); //
        // Use this.
        echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        return $pdo->real_escape_string($string);
    }
    function mysql_entities_fix_string($pdo, $string) {
        return htmlentities((mysql_fix_string($pdo, $string)));
    }
    ?>
</section>
<section>
    <h2>MySQL en databases oefening 1</h2>
    <?php
    require_once 'db/login_users_test.php';

    try {
        $pdo = new PDO($attr, $user, $pass, $opts);
    }
    catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    if (isset($_POST['name']) &&
        isset($_POST['email']) &&
        isset($_POST['password']))
    {
        $name = get_post($pdo, 'name');
        $email = get_post($pdo, 'email');
        $password = password_hash(get_post($pdo, 'password'), PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $statement = $pdo->prepare($query);
        $statement->execute([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);
    }
    echo <<<_END
    <form action="tester.php" method="post"><pre>
         Name <input type="text" name="name">
        email <input type="text" name="email">
     password <input type="text" name="password">
              <input type="submit" value="Add User">
    </pre></form>
    _END;
    ?>
    <h3>Login to user</h3>
    <?php
    require_once 'db/login_users_test.php';

    try {
        $pdo = new PDO($attr, $user, $pass, $opts);
    }
    catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    if (isset($_POST['name_login']) &&
        isset($_POST['password_login']))
    {
        $name = get_post($pdo, 'name_login');
        $password = get_post($pdo, 'password_login');

        $query = "SELECT name, password FROM users WHERE name = :name";
        $statement = $pdo->prepare($query);
        $statement->execute([
            'name' => $name
        ]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])) {
            echo "Login worked! Welcome " . $user['name'];
        } else {
            echo "Login failed.";
        }
    }
    echo <<<_END
    <form action="tester.php" method="post"><pre>
         Name <input type="text" name="name_login">
     password <input type="text" name="password_login">
              <input type="submit" value="Login">
    </pre></form>
    _END;
    ?>
</section>
<section>
    <h2>Form Handeling</h2>
    <?php
    if(!empty($_POST['testName'])) {
        $testName = $_POST['testName'];
    } else {
        $testName = "(Not entered)";
    }
    echo <<<_END
<p>Your name is: $testName</p>
<form method="post" action="tester.php">
    <div>What is your name?</div>
    <input type="text" name="testName">
    <input type="submit">
</form>
_END;

    ?>
</section>
<footer style="margin-top: 1em; height: 4em; background-color: cadetblue; text-align: center">
<h3>Footer</h3>
</footer>
</body>
</html>


