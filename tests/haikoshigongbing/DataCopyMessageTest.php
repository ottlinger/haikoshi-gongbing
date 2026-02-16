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
        $sender = new DataCopyMessage('sender')->getSender();
        $this->assertTrue($sender->isValid());
    }

    public function testSend()
    {
        $this->assertTrue(new DataCopyMessage('sendOutInTest')->send());
    }

    public function testGetSubjectLine()
    {
        // is empty due to missing configuration
        $this->assertNotEmpty(new DataCopyMessage('subjectLine')->getSubjectLine());
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
