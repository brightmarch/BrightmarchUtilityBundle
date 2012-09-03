<?php

namespace Accthub\ApiBundle\Utility\Hasher;

abstract class AbstractHasher
{

    public function __construct()
    {
    }

    /**
     * Hashes a string.
     *
     * @param string $string
     * @return string
     */
    abstract public function hashString($string);
    
    /**
     * Verifies a string equals a hash.
     *
     * @param string $hash
     * @param string $string
     * @return boolean
     */
    abstract public function verifyHash($hash, $string);


    /**
     * Builds a randomized salt for a hashing algorithm.
     *
     * @param string $prefix
     * @return string
     */
    abstract protected function buildSalt($prefix);

}
