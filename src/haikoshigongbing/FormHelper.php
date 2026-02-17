<?php

namespace haikoshigongbing;

class FormHelper
{
    /**
     * Returns true if the given key is found in $_SERVER, false otherwise.
     *
     * @param $key
     *
     * @return bool
     */
    public static function isSetAndNotEmpty($key): bool
    {
        return self::isSetAndNotEmptyInArray($_SERVER, $key);
    }

    /**
     * Returns true if the given key is found in the array, false otherwise.
     *
     * @param $array
     * @param $key
     *
     * @return bool
     */
    public static function isSetAndNotEmptyInArray($array, $key): bool
    {
        if (is_array($array) && !is_null($key)) {
            $array_key_exists = array_key_exists($key, $array);

            return $array_key_exists;
        }

        return false;
    }

    /**
     * Strips the given user input and replaces any XSS-attacks.
     *
     * @param $data
     *
     * @return string
     */
    public static function filterUserInput($data): string
    {
        if (isset($data)) {
            $data = trim(''.$data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            // manual hack to replace quotes here in order to make stuff more DB/MySQL compliant
            $data = strtr($data, ["'" => "\'"]);
        }

        return ''.$data;
    }
}
