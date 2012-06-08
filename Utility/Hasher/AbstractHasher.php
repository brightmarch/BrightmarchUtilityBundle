<?php

namespace Brightmarch\UtilityBundle\Utility\Hasher;

/**
 * Root class for all hashing classes.
 *
 * @author Vic Cherubini <vic@brightmarch.com>
 */
abstract class AbstractHasher
{

    public function __construct()
    {
    }

    abstract public function hashString($string);
    abstract public function verifyHash($hash, $string);



    abstract protected function buildSalt($prefix);
}
