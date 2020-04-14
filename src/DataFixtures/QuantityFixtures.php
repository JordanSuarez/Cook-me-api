<?php


namespace App\DataFixtures;

use App\Entity\Quantity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuantityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $quantity = new Quantity();
        $manager->persist($quantity);
        $manager->flush();
    }
}