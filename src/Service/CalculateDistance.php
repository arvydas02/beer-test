<?php


namespace App\Service;

/**
 * Class CalculateDistance
 * @package App\Service
 */
class CalculateDistance
{
    // Earth radius in kilometers at the equator
    protected const EARTH_RADIUS = 6378.137;

    /**
     * Calculating distance between 2 points in the map
     * Using Haversine formula
     * Return in kilometers
     *
     * @param float $latitudeCurrent
     * @param float $longitudeCurrent
     * @param float $latitudeDestination
     * @param float $longitudeDestination
     * @return int
     */
    public function calculateDistance(
        float $latitudeCurrent,
        float $longitudeCurrent,
        float $latitudeDestination,
        float $longitudeDestination
    ): int
    {
        $latFrom = deg2rad($latitudeCurrent);
        $lonFrom = deg2rad($longitudeCurrent);
        $latTo = deg2rad($latitudeDestination);
        $lonTo = deg2rad($longitudeDestination);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return  round($angle * self::EARTH_RADIUS);
    }
}
