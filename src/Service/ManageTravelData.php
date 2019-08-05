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
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ManageTravelData constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get all locations from database and related data: breweries and beers
     *
     * @return array
     */
    public function loadLocations(): array
    {
        $geoCodes = $this->entityManager->getRepository(GeoCode::class)->findAll();

        $locations = [];
        foreach ($geoCodes as $geoCode) {
            $geoCodeId = $geoCode->getId();
            $breweryId = $geoCode->getBreweryId();

            // Get info about brewery
            $brewery = $this->entityManager->getRepository(Brewery::class)->find($breweryId);

            // Get info about beers
            $beers = $this->entityManager->getRepository(Beer::class)->findBy(['breweryId' => $breweryId]);

            // If there are no beers then skip this brewery
            if (!empty($beers)) {
                // Adding data to travel data array
                $locations[$geoCodeId]['breweryId'] = $breweryId;
                $locations[$geoCodeId]['coordinates'] = [
                    'latitude' => $geoCode->getLatitude(),
                    'longitude' => $geoCode->getLongitude(),
                ];
                $locations[$geoCodeId]['name'] = $brewery->getName();
                $locations[$geoCodeId]['city'] = $brewery->getCity();
                $locations[$geoCodeId]['country'] = $brewery->getCountry();
                foreach ($beers as $beer) {
                    $locations[$geoCodeId]['beers'][$beer->getId()] = $beer->getName();
                }
            }
        }

        return $locations;
    }
}
