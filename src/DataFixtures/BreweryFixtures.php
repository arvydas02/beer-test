<?php

namespace App\DataFixtures;

use App\Entity\Brewery;
use App\Service\LoadDataTrait;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BreweryFixtures extends Fixture
{
    use LoadDataTrait;

    public function load(ObjectManager $manager): void
    {
        $file = __DIR__ . '/Data/breweries.csv';
        $data = $this->loadData($file);

        foreach ($data as $row) {
            $brewery = new Brewery();
            $brewery->setName($row[1]);
            $brewery->setAddress1($row[2]);
            $brewery->setAddress2($row[3]);
            $brewery->setCity($row[4]);
            $manager->persist($brewery);
        }

        $manager->flush();
    }
}
