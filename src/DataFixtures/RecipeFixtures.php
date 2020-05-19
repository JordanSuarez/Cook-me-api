<?php


namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < $_ENV['FIXTURES_QUANTITY']; $i++) {
            $recipe = new Recipe('recipe name '.$i, 'instruction '.$i);
            $recipe->addIngredient($this->getReference('ingredient_'.$i));
            $recipe->setType(rand(1, 3));
            $recipe->setCreatedAt(new \DateTime());
            $this->addReference('recipe_'.$i, $recipe);
            $manager->persist($recipe);
        }
        $manager->flush();
    }
}