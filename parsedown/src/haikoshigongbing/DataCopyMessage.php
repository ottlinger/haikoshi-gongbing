<?php

namespace haikoshigongbing;

class DataCopyMessage
{
    private Email $recipient;
    private Email $sender;
    private string $plainContents;

    /**
     * @param string $plainContents
     */
    public function __construct(string $plainContents)
    {
        $this->plainContents = $plainContents;
        $this->recipient = Email::fromString($plainContents);
        $this->sender = Email::fromString($plainContents);
    }

    public function getRecipient(): Email
    {
        return $this->recipient;
    }

    public function getSender(): Email
    {
        return $this->sender;
    }


}