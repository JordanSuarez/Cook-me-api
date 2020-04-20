<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Quantity;
use App\Entity\QuantityType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class QuantityRepository
 * @package App\Repository
 * @method removeEntity(Quantity $quantity)
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
     * @param int $number
     * @param QuantityType $quantityType
     * @return Quantity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(int $number, QuantityType $quantityType): Quantity
    {
        $quantity = new Quantity($number);
        $quantity->setQuantityType($quantityType);
        $this->save($quantity);
        return $quantity;
    }

    /**
     * @param Quantity $quantity
     */
    public function update(Quantity $quantity)
    {
        try {
            $this->save($quantity, false);
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
    }

    /**
     * @param Quantity $quantity
     */
    public function remove(Quantity $quantity)
    {
        $this->removeEntity($quantity);
    }
}
