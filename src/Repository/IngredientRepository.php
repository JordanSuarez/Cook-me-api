<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Ingredient;
/* use Symfony\Component\Security\Core\User\UserInterface; */

class IngredientRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Ingredient::class;
    }
}
