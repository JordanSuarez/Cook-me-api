<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\QuantityType;
/* use Symfony\Component\Security\Core\User\UserInterface; */

class QuantityTypeRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return QuantityType::class;
    }
}