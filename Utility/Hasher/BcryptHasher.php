<?php

namespace Brightmarch\UtilityBundle\Utility\Hasher;

use Brightmarch\UtilityBundle\Utility\Hasher\AbstractHasher;
use Brightmarch\UtilityBundle\Utility\StringUtility;

/**
 * Hashes a string using the bcrypt algorithm with the blowfish cipher.
 *
 * @author Vic Cherubini <vic@brightmarch.com>
 */
class BcryptHasher extends AbstractHasher
{

    /**
     * The work factor for the bcrypt hash algorithm. It would be best if this number never changes.
     */
    const HASH_WORK_FACTOR = 12;

    public function hashString($string)
    {
        $su = new StringUtility;
        
        $salt = $this->buildSalt($su->randomString(21));
        $hash = crypt($string, $salt);

        return($hash);
    }
    
    public function verifyHash($hash, $string)
    {
        $prefix = substr($hash, 7, 21);
        $salt = $this->buildSalt($prefix);
        
        return(crypt($string, $salt) === $hash);
    }



    protected function buildSalt($prefix)
    {
        return(sprintf('$2a$%d$%s$', self::HASH_WORK_FACTOR, $prefix));
    }

}
