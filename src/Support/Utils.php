<?php
namespace Ian\TelegramAPI\Support;

use Exception;
use InvalidArgumentException;

class Utils
{
    /**
     * Link verification
     *
     * @param $url
     * @return bool
     */
    public static function isValidUrl($url) :bool {
        return (bool) parse_url($url);
    }

    /**
     * Check whether the passed parameter is an array
     *
     * @param $array
     * @return bool
     */
    public static function isArray($array) : bool {
        return is_array($array);
    }

    /**
     * isZeroPrefixed
     *
     * @param string
     * @return bool
     */
    public static function isZeroPrefixed($value)
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('The value to isZeroPrefixed function must be string.');
        }
        
        return (strpos($value, '0x') === 0);
    }
}
