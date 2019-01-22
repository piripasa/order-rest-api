<?php

namespace App\Services;

use Exception;

/**
 * Class GoogleMapService
 * @package App\Services
 */
class GoogleMapService
{

    /**
     * @param $lat1
     * @param $lng1
     * @param $lat2
     * @param $lng2
     * @return mixed
     * @throws Exception
     */
    public static function getDrivingDistance($lat1, $lng1, $lat2, $lng2)
    {
        $mapKey = env('GOOGLE_MAP_API_KEY');

        if (!$mapKey) {
            throw new \Exception("Google map key not provided");
        }

        try {
            $url = sprintf("https://maps.googleapis.com/maps/api/distancematrix/json?origins=%s,%s&destinations=%s,%s&sensor=false&key=%s", $lat1, $lng1, $lat2, $lng2, $mapKey);
            $result = file_get_contents($url, false, stream_context_create([
                "ssl" => [
                    "verify_peer"=>false,
                    "verify_peer_name"=>false
                ]
            ]));
            $data = json_decode(utf8_encode($result), true);

            if (!json_last_error()) {
                if ($data['rows'][0]['elements'][0]['status'] == 'OK')
                    return $data['rows'][0]['elements'][0]['distance']['value'];
            }

            throw new \Exception("Error in distance matrix");
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}