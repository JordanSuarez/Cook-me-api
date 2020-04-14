<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\RecipeType;
/* use Symfony\Component\Security\Core\User\UserInterface; */

class RecipeTypeRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return RecipeType::class;
    }
}
