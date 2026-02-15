<?php

namespace haikoshigongbing;

class DataCopyMessage
{
    private Email $recipient;
    private Email $sender;
    private string $plainContents;
    private string $timestamp;
    private string $subjectLine;

    /**
     * @param string $plainContents
     */
    public function __construct(string $plainContents)
    {
        $this->plainContents = $plainContents;
        $this->recipient = Email::fromString(getFromConfiguration('recipient'));
        $this->sender = Email::fromString(getFromConfiguration('sender'));
        $this->timestamp = date('Y-m-d H:i:s');
        $this->subjectLine = '[Haikoshi-Gongbing] Datensicherung vom ' . $this->timestamp;
    }

    public function getRecipient(): Email
    {
        return $this->recipient;
    }

    public function getSender(): Email
    {
        return $this->sender;
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
        $header = $this->_createCommonHeaders();
        $success = mail($this->getRecipient(), $this->getSubjectLine(), $this->getMailText(), $header);
        if (!$success) {
            echo "Error message: " . error_get_last()['message'];
        }
        return $success;
    }

    function _createCommonHeaders(): string
    {
        $serverName = 'localhost';
        $header = 'MIME-Version: 1.0' . "\r\n";
        $header .= "Content-Type: text/html; charset=\"utf-8\"\r\n" . "Content-Transfer-Encoding: 8bit\r\n";
        $header .= 'From: Haikoshi Gongbing <' . $this->getSender() . '>' . "\r\n";
        $header .= 'X-Mailer: HaikoshiGongbing-' . phpversion() . "\r\n";
        $header .= 'Message-ID: <' . time() . rand(1, 1000) . '_' . date('YmdHis') . '@' . $serverName . '>' . "\r\n";
        return $header;
    }

    function getMailText(): string
    {
        $userAgent = 'none';
        if (FormHelper::isSetAndNotEmpty('HTTP_USER_AGENT')) {
            $userAgent = FormHelper::filterUserInput($_SERVER['HTTP_USER_AGENT']);
        }

        $remoteAddress = 'none';
        if (FormHelper::isSetAndNotEmpty('REMOTE_ADDR')) {
            $remoteAddress = FormHelper::filterUserInput($_SERVER['REMOTE_ADDR']);
        }

        return '<html lang="en"><head><title>Haikoshi-Datensicherung</title></head>
            <body><h1>' . $this->getSubjectLine() . '</h1>
              <table>
               <tr>
               <td><b>Time:</b></td>
               <td>' . $this->getTimestamp() . '</td>
               </tr>
               <tr>
               <td><b>Inhalt:</b></td>
               <td>' . $this->getPlainContents() . '</td>
               </tr>
               <tr>
               <td><b>Caller-IP:</b></td>
               <td>' . $remoteAddress . '</td>
               </tr>
               <tr>
               <td><b>Caller-Agent:</b></td>
               <td>' . $userAgent . '</td>
               </tr>
              </table>
            </body>
            </html>';
    }


}