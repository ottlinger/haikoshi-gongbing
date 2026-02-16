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
        $this->assertNotEmpty(DataCopyMessage::getMailText());
    }

    public function testGetTimestamp()
    {
        $this->assertNotEmpty(DataCopyMessage::getTimestamp());
    }

    public function testGetSender()
    {
        // is empty due to missing configuration
        $this->assertEmpty(new DataCopyMessage('sender')->getSender());
    }

    public function testSend()
    {

    }

    public function testConvertLineBreaksToHtml()
    {

    }

    public function testGetSubjectLine()
    {
        // is empty due to missing configuration
        $this->assertEmpty(new DataCopyMessage('subjectLine')->getSubjectLine());
    }

    public function test_createCommonHeaders()
    {
        $this->assertNotEmpty(new DataCopyMessage('headers')->_createCommonHeaders());
    }

    public function testGetRecipient()
    {
        // is empty due to missing configuration
        $this->assertNotEmpty(new DataCopyMessage('recipient')->getRecipient());
    }
}
