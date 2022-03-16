<?php

namespace App\Enums;

abstract class AbstractEnum
{

    /**
     * Return all constants
     *
     * @return array
     */
    static function getConstants(): array
    {
        $reflectionClass = new \ReflectionClass(get_called_class());

        return $reflectionClass->getConstants();
    }


    /**
     * Return all values of constants
     *
     * @return array
     */
    static function getValues(): array
    {
        $allConstants = static::getConstants();

        return array_values($allConstants);
    }
}
