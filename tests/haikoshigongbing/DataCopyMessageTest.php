<?php

namespace haikoshigongbing;

use PHPUnit\Framework\TestCase;

class DataCopyMessageTest extends TestCase
{
    public function test__construct()
    {
        $this->assertEquals('plainContentsInTest', new DataCopyMessage('plainContentsInTest')->getPlainContents());
    }

    public function testGetMailText()
    {

    }

    public function testGetTimestamp()
    {

    }

    public function testGetSender()
    {

    }

    public function testSend()
    {

    }

    public function testConvertLineBreaksToHtml()
    {

    }

    public function testGetSubjectLine()
    {

    }

    public function test_createCommonHeaders()
    {

    }

    public function testGetRecipient()
    {

    }
}
