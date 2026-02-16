<?php

session_start();
unset($_SESSION['haikoshi']);
session_destroy();
header('Location: login.php');
exit;
