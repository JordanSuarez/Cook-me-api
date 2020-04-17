<?php


namespace App\DataFixtures;

use App\Entity\Quantity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuantityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $quantity = new Quantity($i);
            $quantity->setQuantityType($this->getReference('quantity_type_'.$i));
            $this->addReference('quantity_'.$i, $quantity);
            $manager->persist($quantity);
        }
        $manager->flush();
    }
}