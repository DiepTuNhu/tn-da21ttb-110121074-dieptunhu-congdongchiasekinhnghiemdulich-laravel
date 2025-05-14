<?php

namespace App\Helpers;

class GeoHelper
{
    /**
     * Tính khoảng cách giữa hai tọa độ (latitude, longitude) bằng công thức Haversine.
     *
     * @param float $lat1 Latitude của điểm thứ nhất
     * @param float $lon1 Longitude của điểm thứ nhất
     * @param float $lat2 Latitude của điểm thứ hai
     * @param float $lon2 Longitude của điểm thứ hai
     * @return float Khoảng cách tính bằng km
     */
    public static function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Bán kính Trái Đất tính bằng km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance; // Khoảng cách tính bằng km
    }
}