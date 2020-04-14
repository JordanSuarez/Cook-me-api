<?php


namespace App\DataFixtures;

use App\Entity\Quantity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuantityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $quantity = new Quantity(2);
        $quantity->setQuantityType($this->getReference('quantity_type_1'));
        $manager->persist($quantity);
        $quantity2 = new Quantity(32);
        $quantity2->setQuantityType($this->getReference('quantity_type_1'));
        $manager->persist($quantity2);
        $manager->flush();
    }
}