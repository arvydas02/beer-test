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
     * @var ManageTravelData
     */
    protected $manageTravelData;

    /**
     * ManageBreweryVisits constructor.
     * @param CalculateDistance $calculateDistance
     * @param ManageTravelData $manageTravelData
     */
    public function __construct(CalculateDistance $calculateDistance, ManageTravelData $manageTravelData)
    {
        $this->calculateDistance = $calculateDistance;
        $this->manageTravelData = $manageTravelData;
    }

    /**
     * @param array $travelData
     * @param array $coordinates
     * @param int $travelDistance
     * @return array
     */
    public function breweryVisits(array $travelData, array $coordinates, int $travelDistance = 2000): array
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

        if (!$travelData) {
            return $visits;
        }

        while ($travelDistance > 0) {
            $breweryId = key($travelData);

            // Adding for testing
            if (in_array($breweryId, $visitedBreweries)) {
                unset($travelData[$breweryId]);
                continue;
            }

            if (empty($breweryId)) {
                break;
            }

            $distance = $travelData[$breweryId]['distance'];
            $nextCoordinates = $travelData[$breweryId]['coordinates'];
            $travelDistance -= $distance;

            // Check if we can go back home
            $distanceToHome = $this->calculateDistance->calculateDistance(
                $nextCoordinates['latitude'],
                $nextCoordinates['longitude'],
                $homeCoordinates['latitude'],
                $homeCoordinates['longitude']
            );

            // If we cannot go home then skip this destination
            if ($distanceToHome > $travelDistance) {
                break;
            }

            $visitedBreweries[] = $breweryId;
            $lastDistanceToHome = $distanceToHome;

            // Add to visit array - travels
            $visits['travels'][] =  '('.$breweryId.') ' . $travelData[$breweryId]['name'] . ', '
                . $travelData[$breweryId]['city'] . ', ' . $travelData[$breweryId]['country']  . ': '
                . $nextCoordinates['latitude'] . ', ' . $nextCoordinates['longitude'] . ' distance '
                . $travelData[$breweryId]['distance'] . ' km';

            // Add to visit array - beers
            $visits['beers'] += $travelData[$breweryId]['beers'];

            // Add to visit array - total
            $visits['total'] += $travelData[$breweryId]['distance'];

            // Update travel data by ne coordinates
            $travelData = $this->manageTravelData->loadTravelDataByCoordinates($nextCoordinates, $visitedBreweries);
            if (empty($travelData)) {
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
}
