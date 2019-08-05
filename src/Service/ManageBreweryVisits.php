<?php


namespace App\Service;

/**
 * Class ManageBreweryVisits
 * @package App\Service
 */
class ManageBreweryVisits
{
    /**
     * @var CalculateDistance
     */
    protected $calculateDistance;

    /**
     * ManageBreweryVisits constructor.
     * @param CalculateDistance $calculateDistance
     */
    public function __construct(CalculateDistance $calculateDistance)
    {
        $this->calculateDistance = $calculateDistance;
    }

    /**
     * @param array $locations
     * @param array $coordinates
     * @param int $travelDistance
     * @return array
     */
    public function breweryVisits(array $locations, array $coordinates, int $travelDistance = 2000): array
    {
        // Set Home coordinates as initial coordinates
        $homeCoordinates = $coordinates;
        $lastDistanceToHome = 0;
        $visitedBreweries = [];
        $visits = [
            'travels' => [
                'HOME: ' . $homeCoordinates['latitude'] . ', ' . $homeCoordinates['longitude'],
            ],
            'beers' => [],
            'total' => 0,
        ];

        if (empty($locations)) {
            return $visits;
        }

        $geoCodes = $this->calculateLocationDistance($locations, $coordinates, $visitedBreweries, $travelDistance);

        while ($travelDistance > 0) {
            $geoCodeId = key($geoCodes);
            $distance = $geoCodes[$geoCodeId];
            $breweryId =  $locations[$geoCodeId]['breweryId'];

            // Update coordinates
            $coordinates = $locations[$geoCodeId]['coordinates'];

            // Update Travel distance
            $travelDistance -= $distance;

            // Check if we can go back home
            $distanceToHome = $this->calculateDistance->calculateDistance(
                $coordinates['latitude'],
                $coordinates['longitude'],
                $homeCoordinates['latitude'],
                $homeCoordinates['longitude']
            );

            // If we cannot go home then skip this destination and do not search any new ones
            if ($distanceToHome > $travelDistance) {
                break;
            }

            $visitedBreweries[$breweryId] = $breweryId;
            $lastDistanceToHome = $distanceToHome;

            // Add to visit array - travels
            $visits['travels'][] =  '('.$breweryId.') ' . $locations[$geoCodeId]['name'] . ', '
                . $locations[$geoCodeId]['city'] . ', ' . $locations[$geoCodeId]['country']  . ': '
                . $coordinates['latitude'] . ', ' . $coordinates['longitude'] . ' distance '
                . $distance . ' km';

            // Add to visit array - beers
            $visits['beers'] += $locations[$geoCodeId]['beers'];

            // Add to visit array - total
            $visits['total'] += $distance;

            // Update geo codes data by new coordinates
            $geoCodes = $this->calculateLocationDistance($locations, $coordinates, $visitedBreweries, $travelDistance);
            if (empty($geoCodes)) {
                break;
            }
        }

        if ($lastDistanceToHome > 0) {
            $visits['travels'][] = 'HOME: ' . $homeCoordinates['latitude'] . ', '
                . $homeCoordinates['longitude'] . ' distance ' . $lastDistanceToHome . ' km';
            $visits['total'] += $lastDistanceToHome;
        }

        return $visits;
    }

    /**
     * Calculate locations distance by given coordinates
     * It will filter geo locations by max distance that helicopter can travel
     * It will return filtered and sorted geo codes with distance value form given coordinates
     *
     * @param array $locations
     * @param array $coordinates
     * @param array $visitedBreweries
     * @param int $maxDistance
     * @return array
     */
    private function calculateLocationDistance(
        array $locations,
        array $coordinates,
        array $visitedBreweries,
        int $maxDistance
    ): array
    {
        $geoCodes = [];
        foreach ($locations as $geoCodeId => $location) {
            $distance = $this->calculateDistance->calculateDistance(
                $coordinates['latitude'],
                $coordinates['longitude'],
                $location['coordinates']['latitude'],
                $location['coordinates']['longitude']
            );

            if ($distance > 0 && $distance < $maxDistance && empty($visitedBreweries[$location['breweryId']])) {
                $geoCodes[$geoCodeId] = $distance;
            }
        }

        // Sorting geo codes with by distance
        asort($geoCodes);

        return $geoCodes;
    }
}
