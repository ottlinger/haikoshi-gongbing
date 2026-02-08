<?php
// TBD password magic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
header("Refresh:0; url=" . $_GET['ref']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Haikoshi - Login</title>
</head>
<body>
<?php
} else {
    $referer = $_SERVER['HTTP_REFERER'] ?? '/read.php';
    echo '<h1>Speak, friend, and enter.</h1>';
    echo '<form action="/login.php?ref=' . $referer . '" method="post">';
    echo '<label for="password">Passwort:</label>';
    echo '<input type="password" name="password" id="password" /><br /><br />';
    echo '<input type="submit" class="styled-button" value="🔞 Einloggen"><hr />';
    echo '</form>';
    echo '🫶 Created by <a href="https://aiki-it.de" target="_blank">AIKI IT</a> &copy; 2025-' . date("Y");
}

?>
</body>
</html>