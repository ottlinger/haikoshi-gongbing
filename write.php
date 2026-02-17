<?php
session_start();
if (!isset($_SESSION['haikoshi'])) {
    header("Location: ./login.php");
    exit;
}

require_once "inc/all.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contents'])) {
    pageHeader('Speichern');
} else {
    pageHeader('Editieren');
}

$targetFile = getFromConfiguration("dataFileName");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contents'])) {

// SAVING A BACKUP of current state
    echo 'Sending old state via email 🐌 ....<br />';
    sendAsMail();

// FLUSHING
    echo 'Flushing ..... ';

    $result = '';
    if(is_writable($targetFile)) {
        $result = file_put_contents($targetFile, $_POST['contents']);
    }

    if (!$result) {
        echo '<p>💥 Unable to write data file - please go back and try again and fix permission problems if running locally.</p>';
    } else {
        echo '🪠 ' . $result . ' bytes<br /><hr />';
    }

    echo '<a href="./read.php" class="styled-button" accesskey="e">📖 Ansehen</a>';
    logoutButton();

} else {
    $contents = file_exists($targetFile) ? file_get_contents($targetFile) : "## Your Markdown hier";

    echo '<form action="./write.php" method="post">';
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
