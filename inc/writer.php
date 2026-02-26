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
    $dataFileHeader = '<?php die("Curiosity killed the cat.");';

    $targetFile = getFromConfiguration('dataFileName');
    // as is_writable fails if the file does not yet exist the second condition handles this case
    if (is_writable($targetFile) || !file_exists($targetFile)) {
        return file_put_contents($targetFile, $dataFileHeader . $data);
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
    $dataFileHeader = '<?php die("Curiosity killed the cat.");';

    $targetFile = getFromConfiguration('dataFileName');
    if (is_readable($targetFile)) {
        return str_replace($dataFileHeader, '', file_get_contents($targetFile));
    }

    return false;
}
