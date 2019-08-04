<?php


namespace App\Service;

use App\Entity\Beer;
use App\Entity\Brewery;
use App\Entity\GeoCode;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ManageTravelData
 * @package App\Service
 */
class ManageTravelData
{
    /**
     * @var CalculateDistance
     */
    protected $calculateDistance;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ManageTravelData constructor.
     * @param CalculateDistance $calculateDistance
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(CalculateDistance $calculateDistance, EntityManagerInterface $entityManager)
    {
        $this->calculateDistance = $calculateDistance;
        $this->entityManager = $entityManager;
    }

    /**
     * Get data from database and calculate distances
     * Also filter by max distance
     * It is set to 1000 km because helicopter can fly only 2000km and need to come back home
     *
     * @param array $coordinates
     * @param array $visitedBreweries
     * @param int $maxDistance
     * @return array
     */
    public function loadTravelDataByCoordinates(array $coordinates, array $visitedBreweries = [], int $maxDistance = 1000): array
    {
        $geoCodes = $this->entityManager->getRepository(GeoCode::class)->findAll();

        $travelData = [];
        foreach ($geoCodes as $geoCode) {

            // Skip Geo location if it was already visited
            if (in_array($geoCode->getBreweryId(), $visitedBreweries)) {
                continue;
            }

            // Get distance
            $distance = $this->calculateDistance->calculateDistance(
                $coordinates['latitude'],
                $coordinates['longitude'],
                $geoCode->getLatitude(),
                $geoCode->getLongitude()
            );

            if ($distance > 0 && $distance < $maxDistance) {

                // Get Info about brewery
                $brewery = $this->entityManager->getRepository(Brewery::class)->find($geoCode->getBreweryId());

                // Get info about beers
                $beers = $this->entityManager->getRepository(Beer::class)->findBy(['breweryId' => $geoCode->getBreweryId()]);

                // if there are no beers then skip them
                if (empty($beers)) {
                    continue;
                }

                $travelData[$geoCode->getBreweryId()]['distance'] = $distance;
                $travelData[$geoCode->getBreweryId()]['coordinates'] = [
                    'latitude' => $geoCode->getLatitude(),
                    'longitude' => $geoCode->getLongitude(),
                ];
                $travelData[$geoCode->getBreweryId()]['name'] = $brewery->getName();
                $travelData[$geoCode->getBreweryId()]['city'] = $brewery->getCity();
                $travelData[$geoCode->getBreweryId()]['country'] = $brewery->getCountry();
                foreach ($beers as $beer) {
                    $travelData[$geoCode->getBreweryId()]['beers'][$beer->getId()] = $beer->getName();
                }
            }

            // Sort array by distance
            uasort($travelData, function($a, $b){
                return (int)$a['distance'] > (int)$b['distance'] ? 1 : -1;
            });
        }

        return $travelData;
    }
}
