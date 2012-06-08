<?php

namespace Brightmarch\UtilityBundle\Tests\Unit\Utility\Hasher;

use Brightmarch\UtilityBundle\Utility\Hasher\PlaintextHasher;
use Brightmarch\UtilityBundle\Tests\TestCase;

/**
 * @group BrightmarchUtilityBundle
 * @group BrightmarchUtilityBundleUnitPlaintextHasher
 */
class PlaintextHasherTest extends TestCase
{

    public function testHashStringLeavesStringUnchanged()
    {
        $string = uniqid();
        $hasher = new PlaintextHasher;

        $this->assertEquals($string, $hasher->hashString($string));
    }

    public function testVerificationRequiresTwoEqualStrings()
    {
        $string = uniqid();
        $hasher = new PlaintextHasher;

        $this->assertFalse($hasher->verifyHash(uniqid(), $string));
    }

    public function testVerification()
    {
        $string = uniqid();
        $hasher = new PlaintextHasher;
        $hash = $hasher->hashString($string);

        $this->assertTrue($hasher->verifyHash($hash, $string));
    }

}
