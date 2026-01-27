<html>
<body>

<?php

$targetFile = 'data.md';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contents'])) {

echo 'Flushing .....<br />';
$content = $_POST['contents']; 

$result = file_put_contents($targetFile, $content);

if(!$result) {
echo 'Error during write - try again';
} else {
// echo '<i>'.$content.'</i><br />';
echo 'Flushed '.$result.' bytes<br />';
echo 'Return to <a href="/read.php">user view</a>';
}

} else {
$contents = file_get_contents($targetFile);

echo 'Hilfe, was ist <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank">Markdown</a> nochmal .....<br /><hr /><br />';
echo '<form action="/write.php" method="post">';
echo '<label for="contents">Schreib hier rein, was Du Dir speichern willst:</label><br />';
echo '<textarea id="contents" name="contents" rows="50" cols="70">';

if(!$contents) {
echo "Dein Markdown hier";
} else {
echo $contents;
} // no contents

echo '</textarea><br /><br />';
echo '<input type="submit" value="Aktualisieren">';
echo '</form>';

} // POST
?>

</body>
</html>
