<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Recipe;
/* use Symfony\Component\Security\Core\User\UserInterface; */

class RecipeRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Recipe::class;
    }
}
