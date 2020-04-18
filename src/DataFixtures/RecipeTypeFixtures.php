<?php


namespace App\DataFixtures;

use App\Entity\RecipeType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < $_ENV['FIXTURES_QUANTITY']; $i ++) {
            $recipeType = new RecipeType('type name '.$i);
            $this->addReference('recipe_type_'.$i, $recipeType);
            $manager->persist($recipeType);
        }
        $manager->flush();
    }
}