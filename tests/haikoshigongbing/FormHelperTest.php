<?php

declare(strict_types=1);

namespace haikoshigongbing;

use PHPUnit\Framework\TestCase;

final class FormHelperTest extends TestCase
{
    public function testFilteringOnUserInput(): void
    {
        $this->assertEquals('//woo&amp;&quot;', FormHelper::filterUserInput('   \\//woo&"'));
    }

    public function testCheckingKeyInServerArray(): void
    {
        $_SERVER['TESTKEY'] = 10203;
        $this->assertTrue(FormHelper::isSetAndNotEmpty('TESTKEY'));
        $this->assertFalse(FormHelper::isSetAndNotEmpty('TESTVALUE'));
    }

    public function testCheckingKeyInGivenArray(): void
    {
        $myArray = array('testkey' => 12345);
        $this->assertTrue(FormHelper::isSetAndNotEmptyInArray($myArray, "testkey"));
    }

}

