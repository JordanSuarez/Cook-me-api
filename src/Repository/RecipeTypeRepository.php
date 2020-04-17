<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\RecipeType;

/**
 * Class RecipeTypeRepository
 * @package App\Repository
 */
class RecipeTypeRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected static function entityClass(): string
    {
        return RecipeType::class;
    }

    /**
     * @param string $name
     * @return RecipeType
     */
    public function create(string $name): RecipeType
    {
        $recipeType = new RecipeType($name);
        $this->saveEntity($recipeType);
        return $recipeType;
    }

    /**
     * @param RecipeType $recipeType
     */
    public function update(RecipeType $recipeType)
    {
        $this->saveEntity($recipeType);
    }

    /**
     * @param RecipeType $recipeType
     */
    public function remove(RecipeType $recipeType)
    {
        $this->removeEntity($recipeType);
    }
}
