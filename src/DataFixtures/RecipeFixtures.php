<?php


namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $recipe = new Recipe("pizza", "test pizza");
        $recipe->setRecipeType($this->getReference('recipe_type_1'));
        /*$recipe->setIngredients($this->getReference('ingredient_2'));*/
        $recipe->setCreatedAt(new \DateTime('now'));
        $manager->persist($recipe);
        $recipe2 = new Recipe("salade", "test salade");
        $recipe2->setRecipeType($this->getReference('recipe_type_2'));
        $recipe2->setCreatedAt(new \DateTime('now'));
        $manager->persist($recipe2);
        $manager->flush();
    }
}