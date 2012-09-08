<?php

namespace Brightmarch\Bundle\UtilityBundle\Utility\Hasher;

use Brightmarch\Bundle\UtilityBundle\Utility\Hasher\AbstractHasher;

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
