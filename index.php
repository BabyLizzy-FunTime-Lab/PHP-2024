<?php
class BunnyFactory {
    private string $ears = "<code>&nbsp;()_()</code><br>";
    private string $feet = '<code>("")("")</code><br>';
    private string $emotion;
    private array $bunnyRecord = [];

    /**
     * Randomly selects an emotion for the bunny.
     * @return void
     */
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

    /**
     * Generates one bunny.
     * @return string
     */
    public function generateBunny() :string {
        $this->emotionSelect();
        return $this->ears . $this->emotion . $this->feet;
    }

    /**
     * Calculates how many bunny pairs there are.
     * @return int
     */
    private function calculateLatestScore() :int {
        $bunnyPairCount = 0;
        // First we calculate on what index the second row starts.
        $bunnyCount = count($this->bunnyRecord);
        $secondRowStartIndex = $bunnyCount/2;
        $secondRowIndex = $secondRowStartIndex;
        // Then compare top row to bottom row.
        for($recordIndex = 0; $recordIndex <= $secondRowStartIndex-1; $recordIndex++) {
            if($this->bunnyRecord[$recordIndex] === $this->bunnyRecord[$secondRowIndex]) {
                // If top matches bottom we add to the score.
                $bunnyPairCount++;
            }
            // Then we move to the next column comparison.
            $secondRowIndex++;
        }
        return $bunnyPairCount;
    }

    /**
     * Saves the score to a text file it creates.
     * @param $latestScore
     * @return void
     */
    private function saveScoreToTextFile($latestScore) :void {
        $file = fopen( "bunnyScore.txt", 'a+') or die("Cloud not write to file");
        $textScore = "Score: " . $latestScore . "\n";
        fwrite($file, $textScore) or die("Cloud not write to file");
        fclose($file);
    }

    /**
     * Reads all scores saved to the created text file.
     * @return array
     */
    private function getAllScoresFromTextFile() :array {
        // Read all scores and store them in the scoreResults array.
        $scoreResults = [];
        $readFile = fopen("bunnyScore.txt", 'r') or die("File not found.");
        while (($recordedScore = fgets($readFile)) !== false) {
            $scoreResults[] = $recordedScore;
        }
        fclose($readFile);
        return $scoreResults;
    }

    /**
     * Triggers score calculation, score saving and score retrieval
     * @return array
     */
    public function getScores() :array {
        // First we calculate the current score
        $currentScore = $this->calculateLatestScore();
        // Save latest score result to text file. This should be a private method.
        $this->saveScoreToTextFile($currentScore);
        // Returns all saved scores ready to be added to the bunnies table in an array.
        return $this->getAllScoresFromTextFile();
    }
}

/**
 * Renders the bunnies and all the scores. The group size must be an even number.
 * @param $groupSize
 * @return void
 */
function makeBunnyGroup($groupSize) :void {
    // The input number must be even.
    if($groupSize % 2 != 0) {
        echo "The number of bunnies must be even.";
        return;
    }
    // Create a bunny factory.
    $bunny = new BunnyFactory();
    // Calculate number of columns & Render the table header
    $columnsNeeded = $groupSize/2;
    echo "<tr><th colspan='$columnsNeeded'>Bunnies</th></tr>";
    // Then we render the rows with the bunnies.
    $numberOfRows = 1;
    while ($numberOfRows <= 2) {
        echo "<tr>";
        for ($columns = 1; $columns <= $columnsNeeded; $columns++) {
            echo "<td>" . $bunny->generateBunny() . "</td>";
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
        if($index+1 === $scoreResultsCount) echo "<td><strong>$score</strong></td>";
        else echo "<td>$score</td>";
        if($columnCount === $columnsNeeded && $index+1 < $scoreResultsCount) {
            echo "</tr><tr>";
            $columnCount = 0;
        }
    }
    echo "</tr>";
}
?>
<h1>Emotional Bunnies</h1>
<table>
    <?php
    // Use even numbers.
    makeBunnyGroup(10);
    ?>
</table>
