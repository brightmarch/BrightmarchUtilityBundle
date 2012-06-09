<?php

namespace Brightmarch\Bundle\UtilityBundle\Tests;

use Brightmarch\Bundle\UtilityBundle\Utility\Parser\JsonParser;

trait UtilityAssertions
{

    /**
     * Custom assertion for testing that a JSON string has a key that equals a value.
     *
     * @param string The JSON string.
     * @param string The expected key in the JSON object.
     * @param string The expected value of the key in the JSON object.
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
     * @param string The response text returned from the Controller.
     * @param string The message being asserted for.
     */
    public function assertJsonErrorEquals($json, $message)
    {
        $this->assertJsonKeyEquals($json, 'message', $message);
    }

} 
