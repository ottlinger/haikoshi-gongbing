<?php
// TBD password magic
// echo -n "your_string" | sha512sum
// admin = define('PASSWORD', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec');
define('PASSWORD', 'a0d4257aaa658f1417b8c7e7487365cf5eab4c695f0eb39f71da3523e9cf5c0b56dcf450093d2b36e344c26fd1ff92d9dcac16116b0ed53091bb0c76628a233f');

/*
    } else if (isset($_GET['ref'])) {
        header('HTTP/1.0 403 Forbidden');

        die('Your session has expired.');
    }
*/
session_set_cookie_params(86400, dirname($_SERVER['HTTP_HOST']) . "/");
session_name('haikoshi-gongbing');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {

    $_SESSION['haikoshi_friend'] = true;
    header("Refresh:0; url=" . $_GET['ref']);
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
$referer = $_SERVER['HTTP_REFERER'] ?? '/read.php';
echo '<h1>Speak, friend, and enter.</h1>';

if (isset($_SESSION['haikoshi_friend'])) {
    echo '<a href="/logout.php">LOGOUT</a>';
}

echo '<form action="/login.php?ref=' . $referer . '" method="post">';
echo '<label for="password">Passwort:</label>';
echo '<input autofocus required type="password" name="password" id="password" value="" placeholder="Your password"/><br /><br />';
echo '<input type="submit" class="styled-button" value="🔞 Einloggen"><hr />';
echo '</form>';
echo '🫶 Created by <a href="https://aiki-it.de" target="_blank">AIKI IT</a> &copy; 2025-' . date("Y");
}

?>
</body>
</html>
