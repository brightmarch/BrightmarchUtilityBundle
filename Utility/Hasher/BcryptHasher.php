<?php

namespace Brightmarch\Bundle\UtilityBundle\Utility\Hasher;

use Brightmarch\Bundle\UtilityBundle\Utility\Hasher\AbstractHasher;
use Brightmarch\Bundle\UtilityBundle\Utility\StringUtility;

class BcryptHasher extends AbstractHasher
{

    /** @const integer */
    const HASH_WORK_FACTOR = 12;

    public function hashString($string)
    {
        $salt = $this->buildSalt((new StringUtility)->randomString(21));
        $hash = crypt($string, $salt);

        return $hash;
    }

    public function verifyHash($hash, $string)
    {
        $prefix = substr($hash, 7, 21);
        $salt = $this->buildSalt($prefix);
        
        return (crypt($string, $salt) === $hash);
    }



    protected function buildSalt($prefix)
    {
        return sprintf('$2a$%d$%s$', self::HASH_WORK_FACTOR, $prefix);
    }

}
