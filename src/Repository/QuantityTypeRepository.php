<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\QuantityType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class QuantityTypeRepository
 * @package App\Repository
 * @method removeEntity(QuantityType $quantityType)
 */
class QuantityTypeRepository extends ServiceEntityRepository
{
    /**
     * QuantityTypeRepository constructor
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuantityType::class);
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
     * @param QuantityType $quantityType
     * @return QuantityType
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(QuantityType $quantityType): QuantityType
    {
        $this->save($quantityType);
        return $quantityType;
    }

    /**
     * @param QuantityType $quantityType
     */
    public function update(QuantityType $quantityType)
    {
        try {
            $this->save($quantityType, false);
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
    }

    /**
     * @param QuantityType $quantityType
     */
    public function remove(QuantityType $quantityType)
    {
        $this->removeEntity($quantityType);
    }
}
