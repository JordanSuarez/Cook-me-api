<?php

namespace App\DataFixtures;

use App\Entity\RecipeType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
    }

    public function getDependencies()
    {
        return [
            QuantityTypeFixtures::class,
            RecipeTypeFixtures::class,
            QuantityFixtures::class,
            IngredientFixtures::class,
            RecipeFixtures::class,
            /*RecipeIngredientFixtures::class,*/
        ];
    }
}
