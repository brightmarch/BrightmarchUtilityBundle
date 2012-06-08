<?php

namespace Brightmarch\UtilityBundle\Utility\Parser;

/**
 * Wraps a JSON string into an easy to use class.
 *
 * @author Vic Cherubini <vic@brightmarch.com>
 */
class JsonParser
{

    private $json = null;

    public function __construct($json)
    {
        $this->json = json_decode($json);
    }

    /**
     * Magic getter for finding a JSON key.
     *
     * @param string The key to search for.
     * @return mixed The matched key's value, null if the key is not found.
     */
    public function __get($key)
    {
        $value = null;
        if ($this->isValid() && property_exists($this->json, $key)) {
            $value = $this->json->$key;
        }

        return($value);
    }

    /**
     * Returns the JSON object or array.
     *
     * @return mixed The JSON object or array.
     */
    public function json()
    {
        return($this->json);
    }

    /**
     * Determines if the JSON passed into this class is valid or not.
     *
     * @return boolean True if the JSON is valid, false otherwise.
     */
    public function isValid()
    {
        return(!is_null($this->json));
    }

    /**
     * Determines if the decoded JSON string is a PHP object.
     *
     * @return boolean True if the JSON is a PHP object, false otherwise.
     */
    public function isObject()
    {
        return(is_object($this->json));
    }

    /**
     * Determines if the decoded JSON string is a PHP array.
     *
     * @return boolean True if the JSON is a PHP array, false otherwise.
     */
    public function isArray()
    {
        return(is_array($this->json));
    }

    /**
     * Determines if the JSON has root level keys passed in as N number of arguments.
     *
     * @param string Any number of parameters that should be root level keys.
     * @return boolean True if the JSON has the root level keys, false otherwise.
     */
    public function hasKeys()
    {
        $matchedKeys = 0;

        $keys = func_get_args();
        $keysCount = func_num_args();

        if ($this->isValid()) {
            foreach ($keys as $key) {
                if (property_exists($this->json, $key)) {
                    $matchedKeys++;
                }
            }
        }

        return($keysCount == $matchedKeys && $keysCount > 0);
    }

}
