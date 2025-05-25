<?php

namespace App\Services;

use App\Helpers\GeoHelper;
use App\Models\DestinationUtility;
use Illuminate\Support\Facades\Http;

class DistanceService
{
    /**
     * Tính khoảng cách và lưu vào bảng trung gian.
     *
     * @param float $latitude Latitude của điểm mới
     * @param float $longitude Longitude của điểm mới
     * @param string $type Loại điểm mới ('destination' hoặc 'utility')
     * @param int $id ID của điểm mới
     */
    public function calculateAndSaveDistances($latitude, $longitude, $type, $id)
    {
        if ($type === 'destination') {
            // Xóa các bản ghi cũ liên quan đến địa điểm này
            \App\Models\DestinationUtility::where('destination_id', $id)->delete();

            $relatedItems = \App\Models\Utility::all();
            foreach ($relatedItems as $item) {
                // Lọc sơ bộ bằng Haversine, chỉ gọi OSRM nếu < 25km
                $haversine = $this->haversineDistance($latitude, $longitude, $item->latitude, $item->longitude);
                if ($haversine <= 40) {
                    $distance = $this->getOsrmDistance($latitude, $longitude, $item->latitude, $item->longitude);
                    if ($distance !== null && $distance <= 30) {
                        \App\Models\DestinationUtility::create([
                            'destination_id' => $id,
                            'utility_id' => $item->id,
                            'distance' => $distance,
                            'status' => 'nearby',
                        ]);
                    }
                    // Nếu cần delay để tránh bị chặn:
                    // usleep(500000); // nghỉ 0.5 giây
                }
            }
        } elseif ($type === 'utility') {
            // Xóa các bản ghi cũ liên quan đến tiện ích này
            \App\Models\DestinationUtility::where('utility_id', $id)->delete();

            $relatedItems = \App\Models\Destination::all();
            foreach ($relatedItems as $item) {
                $haversine = $this->haversineDistance($latitude, $longitude, $item->latitude, $item->longitude);
                if ($haversine <= 40) {
                    $distance = $this->getOsrmDistance($latitude, $longitude, $item->latitude, $item->longitude);
                    if ($distance !== null && $distance <= 30) {
                        \App\Models\DestinationUtility::create([
                            'destination_id' => $item->id,
                            'utility_id' => $id,
                            'distance' => $distance,
                            'status' => 'nearby',
                        ]);
                    }
                    // usleep(500000); // nếu cần
                }
            }
        }
    }

    /**
     * Tính khoảng cách đường chim bay (Haversine) giữa 2 điểm (km)
     */
    public function haversineDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat/2) * sin($dLat/2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng/2) * sin($dLng/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadius * $c;
    }

    // public function getRealDistance($lat1, $lng1, $lat2, $lng2, $mode = 'driving')
    // {
    //     $apiKey = env('GOOGLE_MAPS_API_KEY');
    //     $origin = "$lat1,$lng1";
    //     $destination = "$lat2,$lng2";
    //     $response = Http::get('https://maps.googleapis.com/maps/api/directions/json', [
    //         'origin' => $origin,
    //         'destination' => $destination,
    //         'mode' => $mode, // 'driving', 'walking', 'bicycling'
    //         'key' => $apiKey,
    //     ]);
    //     $data = $response->json();
    //     if (!empty($data['routes'][0]['legs'][0]['distance']['value'])) {
    //         return $data['routes'][0]['legs'][0]['distance']['value'] / 1000; // km
    //     }
    //     return null;
    // }

    public function getOsrmDistance($lat1, $lng1, $lat2, $lng2)
    {
        // OSRM dùng thứ tự: kinh độ, vĩ độ
        $url = "http://router.project-osrm.org/route/v1/driving/{$lng1},{$lat1};{$lng2},{$lat2}?overview=false";
        $response = Http::get($url);
        $data = $response->json();

        if (!empty($data['routes'][0]['distance'])) {
            // Đơn vị mét, chia 1000 ra km nếu muốn
            return $data['routes'][0]['distance'] / 1000;
        }
        return null;
    }
}