<?php
require_once dirname(__FILE__) . '/../src/haikoshigongbing/DataCopyMessage.php';
require_once dirname(__FILE__) . '/../src/haikoshigongbing/Email.php';
require_once dirname(__FILE__) . '/../src/haikoshigongbing/FormHelper.php';

// enable in case you are experiencing problems ;)
ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
error_reporting(E_ALL);

/**
 * Sends out the data file read from disc. All parameters refer to the configuration options configured via {@link config.php}
 * @return void
 * @see config.php
 */
function sendAsMail(): void
{
    if (file_exists(getFromConfiguration("dataFileName"))) {
        $contents = file_get_contents(getFromConfiguration("dataFileName"));
        $msg = new \haikoshigongbing\DataCopyMessage($contents);
        $success = $msg->send();
        if (!$success) {
            echo "<pre>No mail sent, due to: " . error_get_last()['message']."</pre>";
        } else {
            echo "<pre>Sent to " . getFromConfiguration('recipient') . "</pre>";
        }
    } else {
        echo "<h2>No content found yet - this is your first edit. ✨ Congratulations!</h2>";
    }

}


