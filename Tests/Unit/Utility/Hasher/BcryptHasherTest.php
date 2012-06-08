<?php

namespace Brightmarch\UtilityBundle\Tests\Unit\Utility\Hasher;

use Brightmarch\UtilityBundle\Utility\Hasher\BcryptHasher;
use Brightmarch\UtilityBundle\Tests\TestCase;

/**
 * @group BrightmarchUtilityBundle
 * @group BrightmarchUtilityBundleUnitBcryptHasher
 */
class BcryptHasherTest extends TestCase
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
