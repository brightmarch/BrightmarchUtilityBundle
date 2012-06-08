<?php

namespace Brightmarch\UtilityBundle\Utility\Hasher;

use Brightmarch\UtilityBundle\Utility\Hasher\AbstractHasher;

/**
 * Hasher class that does absolutely nothing. Simply returns the string passed in.
 * This is mostly useful for tests where you want fast tests without having to use bcrypt.
 *
 * @author Vic Cherubini <vic@brightmarch.com>
 */
class PlaintextHasher extends AbstractHasher
{

    public function hashString($string)
    {
        return($string);
    }
    
    public function verifyHash($hash, $string)
    {
        return($hash === $string);
    }



    protected function buildSalt($prefix)
    {
        return('');
    }

}
