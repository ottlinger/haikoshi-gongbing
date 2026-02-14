<?php

use haikoshigongbing\FormHelper;

/**
 * Sends out the data file read from disc. All parameters refer to the configuration options configured via {@link config.php}
 * @return void
 * @see config.php
 */
function sendAsMail(): void
{
    echo "<pre>Sending to " . getFromConfiguration('recipient') . "</pre>";

}

function _createCommonHeaders(): string
{
    $serverName = 'localhost';
    $header = 'MIME-Version: 1.0' . "\r\n";
    $header .= "Content-Type: text/html; charset=\"utf-8\"\r\n" . "Content-Transfer-Encoding: 8bit\r\n";
    $header .= 'From: Haikoshi Gongbing <' . getFromConfiguration('sender') . '>' . "\r\n";
    $header .= 'X-Mailer: Mailform-PHP/' . phpversion() . "\r\n";
    $header .= 'Message-ID: <' . time() . rand(1, 1000) . '_' . date('YmdHis') . '@' . $serverName . '>' . "\r\n";

    return $header;
}

function getMailText(): string
{
    $timestamp = date('Y-m-d H:i:s');
    $subjectLine = '[Haikoshi-Gongbing] Datensicherung vom ' . $timestamp;

    $userAgent = 'none';
    if (FormHelper::isSetAndNotEmpty('HTTP_USER_AGENT')) {
        $userAgent = FormHelper::filterUserInput($_SERVER['HTTP_USER_AGENT']);
    }

    $remoteAddress = 'none';
    if (FormHelper::isSetAndNotEmpty('REMOTE_ADDR')) {
        $remoteAddress = FormHelper::filterUserInput($_SERVER['REMOTE_ADDR']);
    }

    return "<html lang='en'><head><title>".$subjectLine.'</title></head>
            <body><h1>'.$subjectLine.'</h1>
              <table>
               <tr>
               <td><b>Time:</b></td>
               <td>'.$timestamp.'</td>
               </tr>
               <tr>
               <td><b>Name:</b></td>
               <td>'.$this->_message->getName().'</td>
               </tr>
               <tr>
               <td><b>Message:</b></td>
               <td>'.$this->_message->getContents().'</td>
               </tr>
               <tr>
               <td><b>Caller-IP:</b></td>
               <td>'.$remoteAddress.'</td>
               </tr>
               <tr>
               <td><b>Caller-Agent:</b></td>
               <td>'.$userAgent.'</td>
               </tr>
               <tr>
               <td><b>E-Mail:</b></td>
               <td>'.strval($this->_message->getEmail()).'</td>
               </tr>
              </table>
            </body>
            </html>';
}

