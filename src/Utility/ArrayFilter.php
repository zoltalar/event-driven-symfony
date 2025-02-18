<?php

namespace App\Utility;

class ArrayFilter 
{
    public static function removeEmptyKeys(array &$array): void
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                static::removeEmptyKeys($value);
            }
            if ($value === null || $value === '') {
                unset($array[$key]);
            }
        }
    }
}
