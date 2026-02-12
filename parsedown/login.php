<?php
require_once "inc/all.php";

// Do not remove as a session needs to be started in order for the login/logout to work at all
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    if (hash("sha512", $_POST['password']) === getFromConfiguration("passwordH") ||
            hash("sha512", $_POST['password']) === getFromConfiguration("passwordP")) {
        $_SESSION['haikoshi'] = "loggedIn";
        header("Location: /read.php");
    } else {
        header('HTTP/1.0 403 Forbidden');
        header("Location: /login.php");
    }
} else {
    pageHeader("Login");

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
