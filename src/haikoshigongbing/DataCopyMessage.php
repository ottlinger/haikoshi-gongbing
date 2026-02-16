<?php

namespace haikoshigongbing;

require_once dirname(__FILE__).'/../../inc/read-config.php';

class DataCopyMessage
{
    private Email $recipient;
    private Email $sender;
    private string $plainContents;
    private string $timestamp;
    private string $subjectLine;
    private bool $send;
    private static string $lineBreak = "\r\n";

    /**
     * @param string $plainContents
     * @param bool   $send
     */
    public function __construct(string $plainContents, bool $send = false)
    {
        $this->plainContents = $plainContents;
        $this->recipient = Email::fromString(getFromConfiguration('recipient'));
        $this->sender = Email::fromString(getFromConfiguration('sender'));
        $this->timestamp = date('Y-m-d H:i:s');
        $this->subjectLine = '[Haikoshi-Gongbing] Datensicherung vom '.$this->timestamp;
        $this->send = $send;
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
        if ($this->send) {
            $header = $this->_createCommonHeaders();
            $success = mail(strval($this->getRecipient()), $this->getSubjectLine(), $this->getMailText(), $header);
            if (!$success) {
                echo '<p>Error message: '.error_get_last()['message'].'</p>';
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
        $header = 'MIME-Version: 1.0'.self::$lineBreak;
        $header .= "Content-Type: text/html; charset=\"utf-8\"".self::$lineBreak;;
        $header .="Content-Transfer-Encoding: 8bit".self::$lineBreak;;
        $header .= 'From: Haikoshi Gongbing 🤖 <'.$this->getSender().'>'.self::$lineBreak;
        $header .= 'X-Mailer: HaikoshiGongbing-v'.phpversion().self::$lineBreak;;
        $header .= 'Message-ID: <'.time().rand(1, 1000).'_'.date('YmdHis').'@'.$serverName.'>'.self::$lineBreak;;

        return $header;
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

        return '<html lang="en"><head><title>🤖 Haikoshi-Datensicherung</title></head>
            <body><h1>'.$this->getSubjectLine().'</h1>
              <table>
               <tr>
               <td><b>Time:</b></td>
               <td>'.$this->getTimestamp().'</td>
               </tr>
               <tr>
               <td><b>Caller-IP:</b></td>
               <td>'.$remoteAddress.'</td>
               </tr>
               <tr>
               <td><b>Caller-Agent:</b></td>
               <td>'.$userAgent.'</td>
               </tr>
              </table>
              <p>
              <code>'.$this->getPlainContents().'</code>
              </p>
            </body>
            </html>';
    }
}
