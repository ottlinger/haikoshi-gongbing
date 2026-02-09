<?php
// echo -n "your_string" | sha512sum
// admin = define('PASSWORD', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec');
const PASSWORD = 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {

//    echo hash("sha512", $_POST['password']) === PASSWORD;

    if (hash("sha512", $_POST['password']) === PASSWORD) {
        $_SESSION['haikoshi'] = "loggedIn";
        header("Location: /read.php");
    } else {
        header('HTTP/1.0 403 Forbidden');
        header("Location: /login.php");
    }
} else {
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
echo '<h1>Speak, friend, and enter.</h1>';

echo '<form action="/login.php" method="post">';
echo '<label for="password">Passwort:</label>';
echo '<input autofocus required type="password" name="password" id="password" value="" placeholder="Your password"/><br /><br />';
echo '<input type="submit" class="styled-button" value="🔞 Einloggen"><hr />';
echo '</form>';
echo '🫶 Created by <a href="https://www.aiki-it.de" target="_blank">AIKI IT</a> &copy; 2025-' . date("Y");
echo '&mdash; running on v' . phpversion() . ' at ' . date("Y-m-d");
}

?>
</body>
</html>
