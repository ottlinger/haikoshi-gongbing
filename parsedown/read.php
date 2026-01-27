<?php

require_once "Parsedown.php";

$Parsedown = new Parsedown();

echo '<a href="/write.php">Editieren</a><br /><hr /><br />';

$contents = file_get_contents('data.md');
if(!$contents) {
echo $Parsedown->text('Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p>
} else {

echo $Parsedown->text($contents);
}
?>
