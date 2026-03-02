<?php

namespace App\Helpers;

class ConvertMeasurements
{

    public static function poundsToKilograms(float $pounds): float
    {
        return round($pounds * 0.453592, 2);
    }

    public static function feetToCentimeters(float $feet): float
    {
        return round($feet * 30,48, 2);
    }


}
