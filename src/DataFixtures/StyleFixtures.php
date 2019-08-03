<?php

namespace App\DataFixtures;

use App\Entity\Style;
use App\Service\LoadDataTrait;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StyleFixtures extends Fixture
{
    use LoadDataTrait;

    public function load(ObjectManager $manager)
    {
        $file = __DIR__ . '/Data/styles.csv';
        $data = $this->loadData($file);

        foreach ($data as $row) {
            $lastModified=  new \DateTime($row[3]);

            $style = new Style();
            $style->setCategoryId($row[1]);
            $style->setName($row[2]);
            $style->setLastModified($lastModified);

            $manager->persist($style);
        }

        $manager->flush();
    }
}
