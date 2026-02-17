<?php

namespace haikoshigongbing;

require_once dirname(__FILE__) . '/../../inc/read-config.php';

class DataCopyMessage
{
    private Email $recipient;
    private Email $sender;
    private string $plainContents;
    private string $timestamp;
    private string $subjectLine;
    private bool $send;
    private string $separator;
    private static string $lineBreak = "\r\n";

    /**
     * @param string $plainContents
     * @param bool $send
     */
    public function __construct(string $plainContents, bool $send = false)
    {
        $this->plainContents = $plainContents;
        $this->recipient = Email::fromString(getFromConfiguration('recipient'));
        $this->sender = Email::fromString(getFromConfiguration('sender'));
        $this->timestamp = date('Y-m-d H:i:s');
        $this->subjectLine = '[Haikoshi-Gongbing] Datensicherung vom ' . $this->timestamp;
        $this->send = $send;
        $this->separator = md5(time());
    }

    public function getRecipient(): Email
    {
        return $this->recipient;
    }

    public function getSender(): Email
    {
        return $this->sender;
    }

    public function getSeparator(): string
    {
        return $this->separator;
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    public function getSubjectLine(): string
    {
        return $this->subjectLine;
    }

    public function getPlainContents(): string
    {
        return $this->plainContents;
    }

    public function send(): bool
    {
        if ($this->send) {
            $header = $this->_createCommonHeaders();
            $success = mail(strval($this->getRecipient()), $this->getSubjectLine(), $this->getMailText(), $header);
            if (!$success) {
                echo '<p>Error message: ' . error_get_last()['message'] . '</p>';
            }

            return $success;
        } else {
            echo '<p>No send out.</p>';

            return true;
        }
    }

    public function _createCommonHeaders(): string
    {
        $serverName = 'localhost';
        $headers = 'MIME-Version: 1.0' . self::$lineBreak;
        $headers .= 'Content-Type: multipart/mixed; boundary="' . $this->getSeparator() . '"' . self::$lineBreak;
        $headers .= 'Content-Type: text/html; charset="utf-8"' . self::$lineBreak;
        $headers .= 'Content-Transfer-Encoding: 8bit' . self::$lineBreak;
        $headers .= 'From: Haikoshi Gongbing 🤖 <' . $this->getSender() . '>' . self::$lineBreak;
        $headers .= 'X-Mailer: HaikoshiGongbing-' . FormHelper::filterUserInput($_SERVER['SERVER_NAME']) . '/' . FormHelper::filterUserInput($_SERVER['SERVER_ADDR']) . '-v' . phpversion() . self::$lineBreak;
        $headers .= 'Message-ID: <' . time() . rand(1, 1000) . '_' . date('YmdHis') . '@' . $serverName . '>' . self::$lineBreak;

        return $headers;
    }

    public function getMailText(): string
    {
        $userAgent = 'none';
        if (FormHelper::isSetAndNotEmpty('HTTP_USER_AGENT')) {
            $userAgent = FormHelper::filterUserInput($_SERVER['HTTP_USER_AGENT']);
        }

        $remoteAddress = 'none';
        if (FormHelper::isSetAndNotEmpty('REMOTE_ADDR')) {
            $remoteAddress = FormHelper::filterUserInput($_SERVER['REMOTE_ADDR']);
        }

        $dataFile = getFromConfiguration('dataFileName');
        $attachmentContent = chunk_split(base64_encode(file_get_contents($dataFile)));
        $attachmentName = 'data.md.txt';

        $message = '<html lang="en"><head><title>🤖 Haikoshi-Datensicherung</title></head>
            <body><h1>' . $this->getSubjectLine() . '@' . FormHelper::filterUserInput($_SERVER['SERVER_NAME']) . '</h1>
              <table>
               <tr>
               <td><b>Time:</b></td>
               <td>' . $this->getTimestamp() . '</td>
               </tr>
               <tr>
               <td><b>Caller-IP:</b></td>
               <td>' . $remoteAddress . '</td>
               </tr>
               <tr>
               <td><b>Caller-Agent:</b></td>
               <td>' . $userAgent . '</td>
               </tr>
               <tr>
               <td><b>Datenmenge im Anhang:</b></td>
               <td>' . $attachmentName . ' mit ' . strlen($attachmentContent) . ' bytes</td>
               </tr>
              </table>
            </body>
            </html>';

        // compose body with message and attachment
        $body = '--' . $this->getSeparator() . self::$lineBreak;
        $body .= 'Content-Type: text/html; charset="utf-8"' . self::$lineBreak;
        $body .= 'Content-Transfer-Encoding: 7bit' . self::$lineBreak . self::$lineBreak;
        $body .= $message . self::$lineBreak;
        $body .= '--' . $this->getSeparator() . self::$lineBreak;
        $body .= 'Content-Type: application/octet-stream; name="' . $attachmentName . '"' . self::$lineBreak;
        $body .= 'Content-Transfer-Encoding: base64' . self::$lineBreak;
        $body .= 'Content-Disposition: attachment; filename="' . $attachmentName . '"' . self::$lineBreak . self::$lineBreak;
        $body .= $attachmentContent . self::$lineBreak;
        $body .= '--' . $this->getSeparator() . self::$lineBreak . '--';

        return $body;
    }
}
