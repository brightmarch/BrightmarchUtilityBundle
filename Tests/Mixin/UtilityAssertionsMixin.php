<?php

namespace Brightmarch\Bundle\UtilityBundle\Tests\Mixin;

use Brightmarch\Bundle\UtilityBundle\Utility\Parser\JsonParser;

trait UtilityAssertionsMixin
{

    /**
     * Custom assertion for testing that a JSON string has a key that equals a value.
     *
     * @param string $json
     * @param string $key
     * @param string $value
     */
    public function assertJsonKeyEquals($json, $key, $value)
    {
        $json = new JsonParser($json);

        $this->assertTrue($json->isValid());
        $this->assertEquals($json->$key, $value);
    }

    /**
     * Custom assertion for testing error messages.
     *
     * @param string $json
     * @param string $message
     */
    public function assertJsonErrorEquals($json, $message)
    {
        $this->assertJsonKeyEquals($json, 'message', $message);
    }

} 
