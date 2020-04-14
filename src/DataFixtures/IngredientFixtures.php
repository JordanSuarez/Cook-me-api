<?php


namespace App\DataFixtures;
use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ingredients = $this->getIngredients();
        foreach ($ingredients as $ingredientData) {
            $ingredient = new Ingredient($ingredientData['name'], $ingredientData['description']);
            $manager->persist($ingredient);
        }
        $manager->flush();
    }

    private function getIngredients(): array
    {
        return [];
    }
}