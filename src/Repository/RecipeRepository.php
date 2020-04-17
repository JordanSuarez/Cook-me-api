<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Ingredient;
use App\Entity\Recipe;

/**
 * Class RecipeRepository
 * @package App\Repository
 */
class RecipeRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected static function entityClass(): string
    {
        return Recipe::class;
    }

    /**
     * @param $name
     * @param $instruction
     * @param Ingredient $ingredient
     * @param $preparationTime
     * @return Recipe
     */
    public function create(string $name, string $instruction, Ingredient $ingredient, int $preparationTime): Recipe
    {
        $recipe = new Recipe($name, $instruction);
        $recipe->setPreparationTime($preparationTime);
        $recipe->addIngredient($ingredient);
        $this->saveEntity($recipe);
        return $recipe;
    }

    /**
     * @param Recipe $recipe
     */
    public function update(Recipe $recipe)
    {
        $this->saveEntity($recipe);
    }

    /**
     * @param Recipe $recipe
     */
    public function remove(Recipe $recipe)
    {
        $this->removeEntity($recipe);
    }

}
