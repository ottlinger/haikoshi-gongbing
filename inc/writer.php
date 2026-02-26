<?php

/**
 * Flushes the given data (with a PHP prefix) to the configured data file.
 *
 * @param $data string markdown data to be flushed to disc.
 *
 * @return false|int number of written bytes or false in case of I/O errors.
 */
function flushToDataFile(string $data): false|int
{
    $dataFileHeader = '<?php die("Curiosity killed the cat.");/*%s*/';

    $targetFile = getFromConfiguration('dataFileName');
    // as is_writable fails if the file does not yet exist the second condition handles this case
    if (is_writable($targetFile) || !file_exists($targetFile)) {
        return file_put_contents($targetFile, sprintf($dataFileHeader, $data));
    }

    return false;
}

/**
 * Reads from the configured data file (without the PHP prefix).
 *
 * @return string|false stripped data or false in case of I/O errors.
 */
function readFromDataFile(): string|false
{
    $dataFileHeaderStart = '<?php die("Curiosity killed the cat.");/*';
    $dataFileHeaderEnd = '*/';

    $targetFile = getFromConfiguration('dataFileName');
    if (is_readable($targetFile)) {
        $fileContents = file_get_contents($targetFile);

        $fileContents = str_replace($dataFileHeaderStart, '', $fileContents);
        return str_replace($dataFileHeaderEnd, '', $fileContents);
    }

    return false;
}
