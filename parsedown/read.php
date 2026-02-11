<?php
session_start();
if (!isset($_SESSION['haikoshi'])) {
    header("Location: /login.php");
    exit;
}
require_once "inc/layout.php";
require_once "Parsedown.php";

pageHeader("Read");
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
