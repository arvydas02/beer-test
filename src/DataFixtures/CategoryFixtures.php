<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Service\LoadDataTrait;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    use LoadDataTrait;

    public function load(ObjectManager $manager)
    {
        $file = __DIR__ . '/Data/categories.csv';
        $data = $this->loadData($file);

        foreach ($data as $row) {

            $lastModified=  new \DateTime($row[2]);

            $category = new Category();
            $category->setName($row[1]);
            $category->setLastModified($lastModified);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
