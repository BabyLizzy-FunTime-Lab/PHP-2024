<?php
include_once 'components/header.php';

createHeader('Read & Write', 'Read & Write');

function saveToText($newMessage) :void {
    $textFile = fopen("messagesRecord.txt", 'a+') or die("Could not connect to file.");
    $textToSave = $newMessage . "\n";
    fwrite($textFile, $textToSave) or die("Could not write");
    fclose($textFile);
}

function readMessages() :array {
    $resultArray = [];
    $readFile = fopen("messagesRecord.txt", 'r') or die("Text File not found");
    while (($recordedMessage = fgets($readFile)) !== false) {
        $resultArray[] = $recordedMessage;
    }
    fclose($readFile);
    return $resultArray;
}
$savedMessages = [];
If(isset($_POST['message'])) {
    saveToText($_POST['message']);
    $savedMessages = readMessages();
}
echo <<<_END
<div>
    <h3>Message Form</h3>
    <form action="readWriteText.php" method="post">
        <label for="message">Message:</label>
        <input name="message" type="text">
        <input type="submit" value="Send">
    </form>
</div>
_END;
?>
<div>
    <h3>All Messages</h3>
    <?php
    foreach ($savedMessages as $message) {
        echo "<p>$message</p>";
    }
    ?>
</div>

