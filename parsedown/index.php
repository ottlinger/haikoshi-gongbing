<?php

require_once "Parsedown.php";

$Parsedown = new Parsedown();

echo $Parsedown->text('Hello @_Haikoshi_ *gongbing*!');
echo "<hr>";
echo "Running on v".phpversion()." at ".date("Y-m-d")."<br/>";

