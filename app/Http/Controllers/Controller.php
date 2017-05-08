<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    public static function addDistance($latitude, $longitude, $distance)
    {
        $earthRadius = 6371;
        $lat1 = deg2rad($latitude);
        $lon1 = deg2rad($longitude);
        $bearing = deg2rad(0);

        $lat2 = asin(sin($lat1) * cos($distance / $earthRadius) + cos($lat1) * sin($distance / $earthRadius) * cos($bearing));
        $lon2 = $lon1 + atan2(sin($bearing) * sin($distance / $earthRadius) * cos($lat1), cos($distance / $earthRadius) - sin($lat1) * sin($lat2));

        return array(rad2deg($lat2), rad2deg($lon2));
    }

    public static function subDistance($latitude, $longitude, $distance)
    {
        $earthRadius = 6371;
        $lat1 = deg2rad($latitude);
        $lon1 = deg2rad($longitude);
        $bearing = deg2rad(0);

        $lat2 = asin(sin($lat1) * cos($distance / $earthRadius) - cos($lat1) * sin($distance / $earthRadius) * cos($bearing));
        $lon2 = $lon1 - atan2(sin($bearing) * sin($distance / $earthRadius) * cos($lat1), cos($distance / $earthRadius) - sin($lat1) * sin($lat2));

        return array(rad2deg($lat2), rad2deg($lon2));
    }
}
