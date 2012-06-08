<?php

namespace Brightmarch\UtilityBundle\Utility;

/**
 * Common string functions.
 *
 * @author Vic Cherubini <vic@brightmarch.com>
 */
class StringUtility
{

    public function __construct()
    {
    }

    /**
     * Creates a random string of a specified length.
     *
     * @param integer The length of the random string to create.
     * @return string A randomly generated string.
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
