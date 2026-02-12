<?php


/**
 * Sends out the data file read from disc. All parameters refer to the configuration options configured via {@link config.php}
 * @return void
 * @see config.php
 */
function sendAsMail(): void
{
    echo "<pre>" . getFromConfiguration('recipient') . "</pre>";
}

