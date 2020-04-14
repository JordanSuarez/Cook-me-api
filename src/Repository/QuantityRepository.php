<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Quantity;
/* use Symfony\Component\Security\Core\User\UserInterface; */

class QuantityRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Quantity::class;
    }
}
