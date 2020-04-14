<?php


namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $recipes = $this->getRecipes();
        foreach ($recipes as $recipeData) {
            $recipe = new Recipe($recipeData['name'], $recipeData['preparation_time'], $recipeData['instruction']);
            $manager->persist($recipe);
        }
        $manager->flush();
    }

    private function getRecipes(): array
    {
        return [];
    }
}