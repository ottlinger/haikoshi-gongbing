<?php
session_start();
if (!isset($_SESSION['haikoshi'])) {
    header("Location: /login.php");
    exit;
}

require_once("inc/logoutButton.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Haikoshi - Read</title>
</head>
<body>

<?php
require_once "Parsedown.php";

$Parsedown = new Parsedown();

echo '<a href="/write.php" class="styled-button" accesskey="e">📖 Editieren</a>';
logoutButton();

if (file_exists('data.md')) {
    echo '<br /><hr /><br />';
    $contents = file_get_contents('data.md');
    echo $Parsedown->text($contents);
} else {
    echo $Parsedown->text('No contents found yet - feel free to create it by hitting _Editeren_');
}

?>
</body>
</html>
