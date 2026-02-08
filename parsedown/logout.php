<?php

unset($_SESSION['haikoshi_friend']);

// Unset all of the session variables.
//$_SESSION = array();
// Finally, destroy the session.
// session_destroy();
header("Refresh:0; url=/login.php");
exit();