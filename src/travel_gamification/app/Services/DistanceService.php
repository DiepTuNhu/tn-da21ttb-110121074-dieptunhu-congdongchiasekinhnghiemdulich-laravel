<?php

namespace App\Services;

use App\Helpers\GeoHelper;
use App\Models\DestinationUtility;

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
            $relatedItems = \App\Models\Utility::all();
            foreach ($relatedItems as $item) {
                $distance = GeoHelper::calculateDistance($latitude, $longitude, $item->latitude, $item->longitude);
                if ($distance <= 5) {
                    DestinationUtility::create([
                        'destination_id' => $id,
                        'utility_id' => $item->id,
                        'distance' => $distance,
                        'status' => 'nearby',
                    ]);
                }
            }
        } elseif ($type === 'utility') {
            $relatedItems = \App\Models\Destination::all();
            foreach ($relatedItems as $item) {
                $distance = GeoHelper::calculateDistance($latitude, $longitude, $item->latitude, $item->longitude);
                if ($distance <= 5) {
                    DestinationUtility::create([
                        'destination_id' => $item->id,
                        'utility_id' => $id,
                        'distance' => $distance,
                        'status' => 'nearby',
                    ]);
                }
            }
        }
    }
}