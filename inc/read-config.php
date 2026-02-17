<?php

// Reads stuff from config.php, therefore not included in other files.
$fileName = dirname(__FILE__).'/config.php';
if (file_exists($fileName) && is_readable($fileName)) {
    $GLOBALS['haikoshi'] = parse_ini_file($fileName);
}

/**
 * Read a value from the config file or return an empty string.
 *
 * @param $key string key inside of the configuration element _haikoshi_
 *
 * @return string
 */
function getFromConfiguration($key): string
{
    if ($GLOBALS['haikoshi'] && isset($GLOBALS['haikoshi'][$key])) {
        return trim(''.$GLOBALS['haikoshi'][$key]);
    }

    return '';
}
