<?php
session_start();
if (!isset($_SESSION['haikoshi'])) {
    header("Location: /login.php");
    exit;
}

require_once "inc/all.php";

pageHeader("Read");
$parsedown = new Parsedown();
$parsedown->setSafeMode(true); // filter stuff as we read user-input

echo '<a href="/write.php" class="styled-button" accesskey="e">📖 Editieren</a>';
logoutButton();

if (file_exists(getFromConfiguration("dataFileName"))) {
    echo '<br /><hr /><br />';
    $contents = file_get_contents(getFromConfiguration("dataFileName"));
    echo $parsedown->text($contents);
} else {
    echo $parsedown->text('No contents found yet - feel free to create it by hitting _Editieren_');
}

?>
</body>
</html>
