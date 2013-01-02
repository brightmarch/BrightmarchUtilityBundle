<?php

namespace Brightmarch\Bundle\UtilityBundle\Utility\Parser;

class JsonParser
{

    private $json = null;

    public function __construct($json)
    {
        $this->json = json_decode($json);
        $this->jsonArray = json_decode($json, true);
    }

    /**
     * Magic getter for finding a JSON key.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        $value = null;
        if ($this->isObject() && property_exists($this->json, $key)) {
            $value = $this->json->$key;
        }

        if ($this->isArray() && array_key_exists($key, $this->json)) {
            $value = $this->json[$key];
        }

        return $value;
    }

    /**
     * Alias for __get().
     */
    public function key($key)
    {
        return $this->__get($key);
    }

    /**
     * Returns the size of teh JSON array.
     *
     * @return integer
     */
    public function size()
    {
        if ($this->isArray()) {
            return count($this->json);
        }

        return 0;
    }

    /**
     * Returns the JSON object or array.
     *
     * @return mixed
     */
    public function json()
    {
        return $this->json;
    }

    /**
     * Returns the parsed JSON string as a PHP array.
     *
     * @return array
     */
    public function asArray()
    {
        return $this->jsonArray;
    }

    /**
     * Decoded JSON is valid.
     *
     * @return boolean
     */
    public function isValid()
    {
        return !is_null($this->json);
    }

    /**
     * Decoded JSON is an object.
     *
     * @return boolean
     */
    public function isObject()
    {
        return is_object($this->json);
    }

    /**
     * Decoded JSON is an array.
     *
     * @return boolean
     */
    public function isArray()
    {
        return is_array($this->json);
    }

    /**
     * Determines if the JSON has root level keys passed in as N number of arguments.
     *
     * @param string $param
     * @return boolean
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

        return ($keysCount == $matchedKeys && $keysCount > 0);
    }

}
