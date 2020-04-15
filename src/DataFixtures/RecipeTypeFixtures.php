<?php


namespace App\DataFixtures;

use App\Entity\RecipeType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $recipeTypeNames = $this->getRecipeTypes();
        foreach ($recipeTypeNames as $key => $value) {
            $recipeType = new RecipeType($value);
            $this->addReference('recipe_type_'.$key, $recipeType);
            $manager->persist($recipeType);
        }
        $manager->flush();
    }

    private function getRecipeTypes(): array
    {
        return [
            'entrée',
            'plat',
            'dessert'
        ];
    }

}