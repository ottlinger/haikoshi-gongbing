<?php

// Check whether the file exists or fallback to the template
// DEVHINT: it's quite odd that file_exists seems to start at root, while parse takes the relative path from this file
$fileName = dirname(__FILE__).'/config.php';
if (file_exists($fileName)) {
 $GLOBALS['haikoshi'] = parse_ini_file($fileName);
} else {
 echo "UNABLE2READ-CFG:";
}

function sendAsMail($fileName)
{
    echo "<pre>nyi</pre>";
}
