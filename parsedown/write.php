<?php
if (!isset($_SESSION['haikoshi_friend'])) {
    header("Location: /login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Haikoshi - Editieren</title>
</head>
<body>
<?php
require_once 'inc/mailer.php';
$targetFile = 'data.md';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contents'])) {

// SAVING A BACKUP of current state
    echo 'Sending old state via mail 🐌 ....<br />';
    sendAsMail($targetFile);

// FLUSHING
    echo 'Flushing ..... ';
    $result = file_put_contents($targetFile, $_POST['contents']);

    if (!$result) {
        echo '💥 Error during write - please go back and try again';
    } else {
        echo '🪠 ' . $result . ' bytes<br /><hr />';
        echo '<a href="/read.php" class="button" accesskey="e">📖 Ansehen</a>';
    }

} else {
    $contents = file_exists($targetFile) ? file_get_contents($targetFile) : "## Your Markdown hier";

    echo '<form action="/write.php" method="post">';
    echo '<input type="submit" class="styled-button" value="💾 Speichern"><hr />';
    echo '<label for="contents">Editierbare Liste:</label><br />';
    echo '<textarea id="contents" name="contents" rows="50" cols="70">';
    echo $contents;
    echo '</textarea><br /><br />';
    echo '</form>';
    echo '<br /><hr /><br />🆘 Hilfe, was ist <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank">Markdown</a> nochmal .....';

} // POST
?>

</body>
</html>
