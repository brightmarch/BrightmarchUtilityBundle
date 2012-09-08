<?php

namespace Brightmarch\UtilityBundle\Utility\Hasher;

use Brightmarch\UtilityBundle\Utility\Hasher\AbstractHasher;

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
