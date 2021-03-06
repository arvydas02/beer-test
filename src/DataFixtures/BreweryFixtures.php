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

            $lastModified=  new \DateTime($row[13]);

            $brewery = new Brewery();
            $brewery->setName($row[1]);
            $brewery->setAddress1($row[2]);
            $brewery->setAddress2($row[3]);
            $brewery->setCity($row[4]);
            $brewery->setState($row[5]);
            $brewery->setCode($row[6]);
            $brewery->setCountry($row[7]);
            $brewery->setPhone($row[8]);
            $brewery->setWebsite($row[9]);
            $brewery->setFilepath($row[10]);
            $brewery->setDescription($row[11]);
            $brewery->setAddUser($row[12]);
            $brewery->setLastModified($lastModified);
            $manager->persist($brewery);
        }

        $manager->flush();
    }
}
