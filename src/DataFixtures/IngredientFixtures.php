<?php


namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < $_ENV['FIXTURES_QUANTITY'] ; $i++) {
            $ingredient = new Ingredient('ingredient_name'.$i, 'ingredient_description'.$i);
            $ingredient->setQuantity($this->getReference('quantity_'.$i));
            $ingredient->setCreatedAt(new \DateTime());
            $this->addReference('ingredient_'.$i, $ingredient);
            $manager->persist($ingredient);
        }
        $manager->flush();
    }
}