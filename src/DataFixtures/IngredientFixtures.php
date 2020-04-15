<?php


namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 5; $i++)
        {
            $ingredient = new Ingredient("ing_name$i", "ing_desc$i");
            $this->addReference('ingredient_'.$i, $ingredient);
            $ingredient->setCreatedAt(new \DateTime('now'));
            $manager->persist($ingredient);
        }
        $manager->flush();
    }
}