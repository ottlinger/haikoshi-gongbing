<?php
// TODO: Set your password here
// echo -n "your_string" | sha512sum
// e.g. admin = define('PASSWORD', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec');
const PASSWORD = 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec';

// 20260209 festgelegt
const PASSWORD_H = '1dc9310b9c0bef45b6824f4247e8aefbe4daf6397c283213bd2cbb6c91fda0e899ccd3bc79e41356cf388259d5f0923ce20ef549e4a6fc0739f3d6975c80f318';


// Do not remove as a session needs to be started in order for the login/logout to work at all
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if (hash("sha512", $_POST['password']) === PASSWORD ||
            hash("sha512", $_POST['password']) === PASSWORD_H) {
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
