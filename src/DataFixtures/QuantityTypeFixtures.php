<?php

namespace App\DataFixtures;

use App\Entity\QuantityType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuantityTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $quantityTypeNames = $this->getQuantityTypes();
        foreach ($quantityTypeNames as $quantityTypeName) {
            $quantityType = new QuantityType($quantityTypeName);
            $manager->persist($quantityType);
        }
        $manager->flush();
    }

    private function getQuantityTypes(): array
    {
        return [
            'gram',
            'centiliter',
            'spoon',
            'unit',
        ];
    }
}
