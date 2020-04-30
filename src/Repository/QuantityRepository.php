<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Ingredient;
use App\Entity\Quantity;
use App\Entity\QuantityType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class QuantityRepository
 * @package App\Repository
 */
class QuantityRepository extends ServiceEntityRepository
{
    /**
     * QuantityRepository constructor
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quantity::class);

    }

    /**
     * @param $entity
     * @param bool $persist
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function save($entity, $persist = true) {
        if($persist) $this->_em->persist($entity);
        $this->_em->flush();
    }

    /**
     * @param Quantity $quantity
     * @return Quantity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Quantity $quantity): Quantity
    {
        $this->save($quantity);

        return $quantity;
    }

    /**
     * @param Quantity $quantity
     * @param int $quantityNumber
     * @param int|null $quantityTypeId
     * @return Quantity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Quantity $quantity, int $quantityNumber, ?int $quantityTypeId = null)
    {
        // find quantityTypeID
        $quantity->setNumber($quantityNumber);
        $this->save($quantity, false);

        return $quantity;
    }

    /**
     * @param Quantity $quantity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Quantity $quantity)
    {
        $this->_em->remove($quantity);
        $this->_em->flush();
    }
}
