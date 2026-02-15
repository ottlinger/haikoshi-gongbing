<?php

/**
 * Sends out the data file read from disc. All parameters refer to the configuration options configured via {@link config.php}
 * @return void
 * @see config.php
 */
function sendAsMail(): void
{
    if (file_exists(getFromConfiguration("dataFileName"))) {
        echo "<pre>Sending to " . getFromConfiguration('recipient') . "</pre>";
        $contents = file_get_contents(getFromConfiguration("dataFileName"));
        $msg = new \haikoshigongbing\DataCopyMessage($contents);
    } else {
        echo "<h2>No content found yet - this is your first edit. ✨ Congratulations!</h2>";
    }


}


