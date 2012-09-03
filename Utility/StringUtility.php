<?php

namespace Brightmarch\Bundle\UtilityBundle\Utility;

class StringUtility
{

    public function __construct()
    {
    }

    /**
     * Creates a random string of a specified length.
     *
     * @param integer $length
     * @return string
     */
    public function randomString($length=32)
    {
        $length = abs((int)$length);
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pool_len = strlen($pool)-1;

        $random = '';
        for ($i=0; $i<$length; $i++) {
            $random .= $pool[mt_rand(0, $pool_len)];
        }
        
        return($random);
    }

}
