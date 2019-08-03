<?php

namespace App\DataFixtures;

use App\Entity\GeoCode;
use App\Service\LoadDataTrait;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GeoCodeFixtures extends Fixture
{
    use LoadDataTrait;

    public function load(ObjectManager $manager)
    {
        $file = __DIR__ . '/Data/geocodes.csv';
        $data = $this->loadData($file);

        foreach ($data as $row) {
            $geoCode = new GeoCode();
            $geoCode->setBreweryId($row[1]);
            $geoCode->setLatitude($row[2]);
            $geoCode->setLongitude($row[3]);
            $geoCode->setAccuracy($row[4]);
            $manager->persist($geoCode);
        }

        $manager->flush();
    }
}
