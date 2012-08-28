<?php

namespace Brightmarch\Bundle\UtilityBundle\Tests\Unit\Utility\Hasher;

use Brightmarch\Bundle\UtilityBundle\Utility\Hasher\BcryptHasher;
use Brightmarch\Bundle\UtilityBundle\Tests\UnitTestCase;

class BcryptHasherTest extends UnitTestCase
{

    public function testHashStringCreatesHash()
    {
        $string = uniqid();
        $hasher = new BcryptHasher;

        $this->assertNotEquals($string, $hasher->hashString($string));
    }

    public function testVerificationRequiresHashedStringWithSalt()
    {
        $string = uniqid();
        $hasher = new BcryptHasher;

        $this->assertFalse($hasher->verifyHash($string, $string));
    }

    public function testVerification()
    {
        $string = uniqid();
        $hasher = new BcryptHasher;
        $hash = $hasher->hashString($string);

        $this->assertTrue($hasher->verifyHash($hash, $string));
    }

}
