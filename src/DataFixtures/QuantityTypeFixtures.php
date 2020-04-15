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
        foreach ($quantityTypeNames as $key => $value) {
            $quantityType = new QuantityType($value);
            $this->addReference('quantity_type_'.$key, $quantityType);
            $manager->persist($quantityType);
        }
        $manager->flush();
    }

    private function getQuantityTypes(): array
    {
        return [
            'gramme',
            'centilitre',
            'cuillère',
            'unité',
            'mililitre'
        ];
    }
}
