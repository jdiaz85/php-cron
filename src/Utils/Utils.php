<?php

namespace App\Utils;

class Utils
{

    /**
     * @param int $number
     * @param int $low
     * @param int $high
     * @return bool
     */
    public static function betweenWithIncludedExtremes(int $number, int $low, int $high): bool
    {
        if ($number >= $low and $number <= $high) {
            return true;
        }
        
        return false;
    }
}
