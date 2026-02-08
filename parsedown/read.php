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
    <title>Haikoshi</title>
</head>
<body>

<?php
require_once "Parsedown.php";

$Parsedown = new Parsedown();

echo '<a href="/write.php" class="button" accesskey="e">📖 Editieren</a>';

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
