<?php

namespace App\DataFixtures;

use App\Entity\Beer;
use App\Service\LoadDataTrait;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BeerFixtures extends Fixture
{
    use LoadDataTrait;

    public function load(ObjectManager $manager): void
    {
        $file = __DIR__ . '/Data/beers.csv';
        $data = $this->loadData($file);

        foreach ($data as $row) {

            $lastModified=  new \DateTime($row[12]);

            $beer = new Beer();
            $beer->setBreweryId($row[1]);
            $beer->setName($row[2]);
            $beer->setCategoryId($row[3]);
            $beer->setStyleId($row[4]);
            $beer->setAbv($row[5]);
            $beer->setIbu($row[6]);
            $beer->setSrm($row[7]);
            $beer->setUpc($row[8]);
            $beer->setFilepath($row[9]);
            $beer->setDescription($row[10]);
            $beer->setAddUser($row[11]);
            $beer->setLastModified($lastModified);
            $manager->persist($beer);
        }

        $manager->flush();
    }
}
