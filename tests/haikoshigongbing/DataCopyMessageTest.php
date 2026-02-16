<?php

namespace haikoshigongbing;

use PHPUnit\Framework\TestCase;

class DataCopyMessageTest extends TestCase
{
    public function testConstruct()
    {
        $this->assertEquals('plainContentsInTest', new DataCopyMessage('plainContentsInTest')->getPlainContents());
    }

    public function testGetMailText()
    {
        $this->assertNotEmpty(new DataCopyMessage('text')->getMailText());
    }

    public function testGetTimestamp()
    {
        $this->assertNotEmpty(new DataCopyMessage('timestamp')->getTimestamp());
    }

    public function testGetSender()
    {
        // is empty due to missing configuration
        $this->assertEmpty(new DataCopyMessage('sender')->getSender());
    }

    public function testSend()
    {
        $this->assertEmpty(new DataCopyMessage('sendOutInTest')->send());
    }

    public function testConvertLineBreaksToHtml()
    {
        $this->assertEquals('contents<br />is</br />king</br >', new DataCopyMessage('contents\r\nis\rking\n')->getPlainContents());
    }

    public function testGetSubjectLine()
    {
        // is empty due to missing configuration
        $this->assertEmpty(new DataCopyMessage('subjectLine')->getSubjectLine());
    }

    public function testCreateCommonHeaders()
    {
        $this->assertNotEmpty(new DataCopyMessage('headers')->_createCommonHeaders());
    }

    public function testGetRecipient()
    {
        // is empty due to missing configuration
        $this->assertNotEmpty(new DataCopyMessage('recipient')->getRecipient());
    }
}
