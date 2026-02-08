<?php
require_once "Parsedown.php";

$Parsedown = new Parsedown();

echo '<a href="/write.php">Editieren</a><br /><hr /><br />';

if (file_exists('data.md')) {
    $contents = file_get_contents('data.md');
    echo $Parsedown->text($contents);
} else {
    echo $Parsedown->text('No contents found yet - feel free to hit _Editeren_');
}
