<?php

session_start();
unset($_SESSION['haikoshi_friend']);
session_destroy();
header("Location: login.php");
exit();