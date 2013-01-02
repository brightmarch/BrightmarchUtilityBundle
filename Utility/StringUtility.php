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
        
        return $random;
    }

    /**
     * Generates a 4th generation UUID.
     * Shamelessly taken from:
     * http://us2.php.net/manual/en/function.uniqid.php#69164
     *
     * @return string
     */
    public function uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
    }

}
