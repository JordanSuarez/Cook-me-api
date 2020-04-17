<?php

namespace App\DataFixtures;

use App\Entity\QuantityType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuantityTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i ++) {
            $quantityType = new QuantityType('quantity type '.$i);
            $this->addReference('quantity_type_'.$i, $quantityType);
            $manager->persist($quantityType);
        }
        $manager->flush();
    }
}
